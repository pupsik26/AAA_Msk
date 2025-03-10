@csrf
<div class="border border-2">
    <div class="row fields">
        <div class="col-md-4">
            <label class="form-label">Название правила</label>
            <input value="{{ !empty($rule) ? $rule->name : "" }}" name="name" type="text" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">Агентство</label>
            <select name="agency_id" class="form-select">
                <option value="">--Выберите Агентство--</option>
                @foreach($agencies as $agency)
                    <option
                        {{ !empty($rule) && $rule->agency_id == $agency['id'] ? "selected='selected'" : "" }} value={{ $agency['id'] }}>{{ $agency['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <hr/>
    <div class="row field-label">
        <label class="form-label col-md-4">Правила</label>
    </div>

    @if(Route::getCurrentRoute()->uri === 'create')
        <div id="conditions" class="conditions">
            <div id="condition-block" data-count="1" class="row fields">
                <span style="all: unset; padding-top: 5px; padding-right: 5px; margin-left: 12px;">
                Если
            </span>
                <div class="col-md-4">
                    <select name="object[]" class="form-select" id="object" onchange="updateSubcategory(this)">
                        <option value="">--Условие--</option>
                        @foreach($objects as $object)
                            <option {{ !empty($conditionModel) && $conditionModel->name == $object->name ? "selected='selected'" : "" }} value={{ $object->name }}>
                                {{ $object->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="condition[]" class="form-select" id="condition" onchange="updateInput(this)">
                        <option value="">--Сначала выберите условие--</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input value="{{ !empty($rule) ? $rule->equality : "" }}" name="equality[]" type="number"
                           class="form-control" id="equality" disabled>
                </div>
                <div class="col-md-1">
                    <button id="remove-rules-btn" type="button" class="btn btn-danger" onclick="removeBtnClick(this)" disabled>
                        -
                    </button>
                    <button id="add-rules-btn" type="button" class="btn btn-success" onclick="addBtnClick()">+</button>
                </div>
            </div>
        </div>
    @else
{{--        @foreach() --}}
{{--            --}}
{{--        @endforeach--}}
    @endif

    <hr/>
    <div class="row fields">
        <div class="col-md-4">
            <label class="form-label">Текст для менеджера</label>
            <textarea name="text" type="text" class="form-control"
                      rows="3">{{ !empty($rule) ? $rule->text : "" }}</textarea>
        </div>
    </div>
    <div class="row fields">
        <div class="col-md-4">
            <div class="form-check">
                <input {{ !empty($rule) && $rule->is_active ? "checked" : "" }} name="is_active" class="form-check-input" type="checkbox">
                <label class="form-check-label">
                    Активное правило
                </label>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .fields {
            margin: 20px;
        }

        .field-label {
            margin-left: 20px;
        }

    </style>
@endpush

@push('scripts')
    <script>
        function updateSubcategory(obj) {
            if (!obj) {return}
            const parent = obj.parentNode.parentNode;
            const categorySelect = parent.querySelector("#object");
            const subcategorySelect = parent.querySelector("#condition");
            const selectedCategory = categorySelect.value;
            const inputValue = parent.querySelector("#equality");

            const subcategories = {!! json_encode($conditions) !!};

            // Очищаем предыдущие подкатегории
            subcategorySelect.innerHTML = "";

            // Заполняем подкатегории в зависимости от выбранной категории
            if (selectedCategory && subcategories[selectedCategory]) {
                Object.entries(subcategories[selectedCategory]).forEach(function ([key, condition]) {
                    const option = document.createElement("option");
                    option.value = key;
                    option.textContent = condition;
                    subcategorySelect.appendChild(option);
                });
            }
            updateInput(inputValue);
        }

        function updateInput(obj) {
            if (!obj) {return}
            const parent = obj.parentNode.parentNode;
            const categorySelect = parent.querySelector("#object");
            const input = parent.querySelector("#equality");
            const selectedCategory = categorySelect.value;

            const equality_list = {!! json_encode($inputOptions) !!};
            input.removeAttribute('max');
            input.removeAttribute('min');

            if (selectedCategory && equality_list[selectedCategory]) {
                Object.entries(equality_list[selectedCategory]).forEach(function ([key, value]) {
                    input.setAttribute(key, value);
                });
            }
            input.disabled = false;
        }

        function addBtnClick() {
            const block = document.getElementById('condition-block');
            const new_block = block.cloneNode(true);
            const parent = document.getElementById('conditions');
            new_block.dataset.count = +new_block.dataset.count + 1;

            const categorySelect = new_block.querySelector("#object");
            const subcategorySelect = new_block.querySelector("#condition");
            const inputValue = new_block.querySelector("#equality");
            const removeBtn = new_block.querySelector('#remove-rules-btn');

            categorySelect.value = "";
            subcategorySelect.innerHTML = "<option value=''>--Сначала выберите условие--</option>";
            inputValue.value = "";
            inputValue.disabled = true;
            removeBtn.disabled = false;

            parent.appendChild(new_block);
        }

        function removeBtnClick(obj) {
            if (!obj) {return}
            const parent = obj.parentNode.parentNode;

            parent.remove();

            if (document.querySelectorAll('#condition-block').length === 1) {
                document.querySelector('#condition-block').querySelector('#remove-rules-btn').disabled = true;
            }
        }

    </script>
@endpush
