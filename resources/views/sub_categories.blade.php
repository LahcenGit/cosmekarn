<li>
    <div class="form-check mb-2">
    <input type="checkbox" class="form-check-input" id="check1" value="{{$sub_categories->id}}" name="categories[]">
    <label class="form-check-label" for="check1">{{ $sub_categories->designation }}</label>
    </div>
</li>
@if ($sub_categories->categories)
    <ul style="margin-left: 1rem;">
        @if(count($sub_categories->childCategories) > 0)
           @foreach($subcategories as $subcategory)
                @include('sub_categories', ['sub_categories' => $subCategories->childCategories])
            @endforeach
        @endif
    </ul>
@endif
