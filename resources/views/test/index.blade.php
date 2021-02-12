<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</script>
</head>
<body>
    <div class="container my-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table id="example1" class="table table-bordered table-striped">
            <thead>                  
                <tr>
                    <th class="text-center" scope="col">
                        <span>ID</span>
                    </th>
                    <th class="text-center" scope="col">
                        <span>Nama</span>
                    </th>
                    <th class="text-center" scope="col">
                        <span>Alamat</span>            
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tests as $key => $test)
                    <tr>
                        <td class="text-center">
                            <span>{{$key + 1}}</span>
                        </td>
                        <td class="text-center">
                            <span>{{$test->nama}}</span>
                        </td>
                        <td class="text-center">
                            <span>{{$test->alamat}}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
                            Create
                        </button>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- Create Modal --}}
    <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}">
                    <label for="nama" class="col-md-4 col-form-label text-md-right">Nama</label>

                    <div class="input-group col-md-8">
                        <input type="text" class="form-control-file" name="nama" id="nama">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>

                    <div class="input-group col-md-8">
                        <input type="text" class="form-control-file" name="alamat" id="alamat">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="butsave">Save changes</button>
            </div>
        </div>
        </div>
    </div>

<script>
$(document).ready(function() {
    //get data using jquery

   
    //insert using ajax
    $('#butsave').on('click', function() {
        var nama = $('#nama').val();
        var alamat = $('#alamat').val();
        if(nama!="" && alamat!=""){
            /*  $("#butsave").attr("disabled", "disabled"); */
            $.ajax({
                url: "{{ route('test.store') }}",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    type: 1,
                    nama: nama,
                    alamat: alamat
                },
                cache: false,
                success: function(dataResult){
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        window.location = "{{ route('test.create') }}";
                        		
                    }
                    else if(dataResult.statusCode==201){
                        alert("Error occured !");
                    }
                    
                }
            });
        }
        else{
            alert('Please fill all the field !');
        }
    });
});
</script>
</body>
</html>