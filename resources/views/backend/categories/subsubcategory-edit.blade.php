@extends('backend.admin-master')
@section('content')

<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ubah Sub-Sub Kategori</h3>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('subsubcategory.update', $subsubcategories->id) }}" enctype="multipart/form-data">
                                @csrf
                                {{-- mengambil data sub categories berdasarkan id dariurl --}}
                                <input type="hidden" name="id" value="{{ $subsubcategories->id }}">
                                <div class="form-group">
                                    <h5>Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select class="form-control" name="category_id" id="">
                                            <option selected disabled>Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $subsubcategories->category_id ? 'selected' : ''}}>
                                                {{ $category->category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Sub Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select class="form-control" name="subcategory_id">
                                            <option value="" selected="" disabled="">Pilih Sub Kategori</option>
                                            @foreach($subcategories as $subsub)
                                            <option value="{{ $subsub->id }}"
                                                {{ $subsub->id == $subsubcategories->subcategory_id ? 'selected' : '' }}>
                                                {{ $subsub->subcategory_name }}
                                            </option>
                                            @endforeach                                            
                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group pt-5 mt-5">
                                    <h5>Sub-Sub Kategori <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="" name="subsubcategory_name" class="form-control" placeholder="Nama Sub-Sub Kategori"
                                        value="{{ $subsubcategories->subsubcategory_name }}">
                                        @error('subsubcategory_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right mt-5 pt-5">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Tambah">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ajak sub category --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function (key, value){
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>'
                                    );
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
</script>

@endsection