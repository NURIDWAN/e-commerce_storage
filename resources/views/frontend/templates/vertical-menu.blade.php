<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Kategori</div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            {{-- mengambil data kateory --}}
            @php
            $categories = App\Models\Category::orderBy('category_name', 'ASC')->get();
            @endphp

            @foreach ($categories as $category )
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="{{ $category->category_icon }}" aria-hidden="true"></i>{{ $category->category_name }}</a>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <div class="row">
                            {{-- mengambil data subcategory --}}
                            @php
                            $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name', 'ASC')->get();
                            @endphp

                            @foreach ($subcategories as $subcat )
                            <div class="col-sm-12 col-md-3">
                                <ul class="links list-unstyled">
                                    <a href="{{ url('subcategory/product'.$subcat->id.'/'.$subcat->subcategory_slug) }}">
                                        <h2 class="title">{{ $subcat->subcategory_name }}</h2>
                                    </a>
                                    {{-- mengambl data subsub category --}}
                                    @php
                                    $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcat->id)->orderBy('subsubcategory_name', 'ASC')->get();
                                    @endphp

                                    @foreach ($subsubcategories as $subsubcat )
                                    <li>
                                        <a href="{{ url('subsubcategory/product/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug) }}">
                                            {{ $subsubcat->subsubcategory_name }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endforeach
                            <!-- /.col -->

                            <!-- /.col -->

                            <!-- /.col -->

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- /.yamm-content -->
                </ul>
                <!-- /.dropdown-menu -->
            </li>
            <!-- /.menu-item -->
            @endforeach


        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->
