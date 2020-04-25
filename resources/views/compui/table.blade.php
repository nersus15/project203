@extends($master, ['modalid' => $modalid, 'extra_js' => $modalData[0]['extra_js']])

@section('page_heading', 'Data Ujian')
@section('datatable')
    <div class="table-wrapper">
        <div class="table-toolbar">
            @if(isset($conf['ada-toolbar']) && isset($conf['ada-toolbar']) )
                <ul class="tool-bar" style="width: 30%; display: flex; flex-direction: row;">
                    @foreach($conf['toolbar'] as $toolbar)
                        {!!$toolbar!!}
                    @endforeach
                </ul>
            @endif
        </div>
        <div style="width: 100%" class="table-responsive">
            <table id="table-data-ujian" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Matakuliah</th>
                        <th>Nama Dosen</th>
                        <th>Jumlah Soal</th>
                        <th>Keterangan</th>
                        <th>tgl Buat</th>
                        <th>tgl Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $k => $v)
                        <tr>
                            <td>{{ $v->id }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" style="color: black; text-decoration: none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $v->nama_mk }}
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <span class="dropdown-item tool-edit" data-id = "{!! $v->id !!}" style="cursor: pointer">Edit</span>
                                        <span class="dropdown-item tool-hapus" data-id ="{!! $v->id !!}" style="cursor: pointer">Hapus</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $v->dosen }}</td>
                            <td>{{ $v->jumlah_soal }}</td>
                            <td>{{ $v->keterangan }}</td>
                            <td>{{ substr($v->created_at, 0, 10) }}</td>
                            <td>{{ $v->updated_at ? substr($v->updated_at, 0, 10) : ''}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $('#btn-add').click(function(){
            var modalid = $(this).data('modalid');           
            $('#' + modalid).modal('show')
        })

        <?php
            print_r($extra_js);
        ?>
    </script>
@endsection
@if(isset($modalData))
    @foreach($modalData as $modal)
        @section($modal['id'])
            @include('compui/modal', ['modal' => $modal])
        @endsection
    @endforeach
@endif
