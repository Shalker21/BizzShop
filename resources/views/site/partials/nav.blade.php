<div class="navi">
    <div class="container">
        <div class="navy">
            <ul><!-- Main menu -->
                <li><a href="/">Početna</a></li>

                @foreach ($categories as $category)
                    <li><a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->category_translation->name }}</a>
                    @if (count($category->childrens) > 0)
                        <ul>
                            @foreach ($category->childrens as $children)
                                <li><a href="{{ route('category.show', ['id' => $children->id]) }}">{{ $children->category_translation->name }}</a>
                                    @if (count($children->childrens) > 0)
                                        <ul>
                                            @foreach ($children->childrens as $child)
                                                <li><a href="{{ route('category.show', ['id' => $child->id]) }}">{{ $child->category_translation->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @else
                                    </li>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    </li>
                    @endif
                @endforeach
                
            </ul> <!-- end main menu -->
        </div>
    </div>
</div>