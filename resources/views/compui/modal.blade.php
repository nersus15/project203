<!-- Modal -->
<div class="modal fade" id="{!! $modal['id'] !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{$modal['title']}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if($modal['tipe'] == 'form')
                <form action="{!! $modal['form']['action'] !!}" id="{!! $modal['form']['id'] !!}" data-method="{!! $modal['form']['method'] !!}" method="POST">
                    @method('post')
                    @csrf
                    @foreach($modal['form']['input'] as $input)
                        <div class="form-group">
                            <label for="" class="control-label">{{ $input['label'] }}</label>
                            @if(! in_array($input['tipe'], array('select', 'textarea', 'checkbox')))
                                <input id="{!! $input['id'] !!}" <?php
                                    if(isset($input['attribute'])){
                                        foreach($input['attribute'] as $k => $v){
                                            echo $k . " = " . $v ." ";
                                        }
                                    }

                                ?> name="{!! $input['name'] !!}" type="{!! $input['tipe'] !!}" class="form-control">
                            @endif

                            @if($input['tipe'] == 'select')
                                <select id="{!! $input['id'] !!}" name="{!! $input['name'] !!}" class="form-control">
                                    @foreach($input['option'] as $k => $v)
                                        <option value="{!! $k !!}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @if($input['tipe'] == 'textarea')
                                <textarea style="width: 100%" rows="5" class="form-controll" name="{!! $input['name'] !!}" id="{!! $input['name'] !!}"></textarea>
                            @endif
                        </div>
                    @endforeach
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <script >
                        var formid = "<?php echo $modal['form']['id'] ?>";
                        var modalid = "<?php echo $modal['id'] ?>";
                        <?php
                            print_r($modal['extra_js']);
                        ?>
                    </script>
                </form>
            @endif
            @if($modal['tipe'] == 'notif')
                <div class="notif">
                    <h3>{{ $modal['notif']['message']}}</h3>
                </div>
            @endif
        </div>
        @if($modal['tipe'] != 'form')
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        @endif
    </div>
</div>
</div>