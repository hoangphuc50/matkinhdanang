<?php
    $categories = Category::tree("product",true);
?>
<div class="col-md-3 col-sm-4">
    @foreach($categories as $category)
        <div class="category">
            <h2 class="category-title">{{$category->name}}
            </h2>

            <ul class="category-product">
                @foreach($category['children'] as $category_child)
                <li>
<<<<<<< HEAD
                    <a href="{{URL::to($category_child->alias)}}">{{$category_child->name}}
=======
                    <a href="{{URL::to('danh-muc/'.$category_child->alias)}}">{{$category_child->name}}
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
                    </a>
                    @if(count($category_child['children'])>0)
                        <ul>
                            @foreach($category_child['children'] as $category_child_2)
                            <li>
<<<<<<< HEAD
                                <a href="{{URL::to($category_child_2->alias)}}">{{$category_child_2->name}}
=======
                                <a href="{{URL::to('danh-muc/'.$category_child_2->alias)}}">{{$category_child_2->name}}
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    @endforeach
    <div class="thong-ke">
        <h2>Hổ trợ trực tuyến</h2>
        
    </div>
</div>