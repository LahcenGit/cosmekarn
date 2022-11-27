<ul style="line-height: 1.69230769;">
    @if(count($categories) > 0)
    @foreach ($categories as $category)
        <li>
            <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="check1" value="{{$category->id}}" name="categories[]">
            <label class="form-check-label" for="check1">{{ $category->designation }}</label>
            </div>
        </li>

        <ul style="margin-left: 1rem;">
            @if(count($category->childCategories))
                @foreach ($category->childCategories as $subCategories)
                    @include('sub_categories', ['sub_categories' => $subCategories])
                @endforeach
            @endif
        </ul>
    @endforeach
    @endif

