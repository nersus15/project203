$(".tool-edit").click(editHandle);
$(".tool-hapus").click(hapusHandle);
function editHandle(){   
    if(!confirm("Yakin ingin Merubah data?"))
        return ;
    var idData = $(this).data('id');
    var formid = "#form-tambah-ujian";
    var settings = {
        "async": false,
        "crossDomain": true,
        'dataType': 'json',
        "url": path + '/api/get/'+idData,
        "method": "GET",
    }   
    data = $.ajax(settings).done(function (response) {
        return response;
    });
    
    if(!data)
       loadModal('notif', 'modal-notif-tambah-data', 'Ada Kesalahan')
    // else    
        data = data.responseJSON;

    $(formid + " input[name = '_method']").val('PUT');
    $(formid).prop('action', path + '/ujian/' + idData);
    $(formid + " #matkul").val(data.nama_mk);
    $(formid + " #dosen").val(data.dosen);
    $(formid + " #soal").val(data.jumlah_soal);
    $(formid + " #keterangan").val(data.keterangan);
    loadModal('form', "modal-tambah-data-ujian");
}

function hapusHandle(){
    if(!confirm("Yakin ingin Menghapus data?"))
        return ;
    var idData = $(this).data('id');
    var token =  $("meta[name='csrf-token']").attr("content");
    $.ajax(
        {
          url: path + '/ujian/' + idData,
          type: 'DELETE',
          data: {
            _token: token,
                id: idData
        },
        success: function (response){
            loadModal('notif', 'modal-notif-tambah-data', response.message);
        }
    });

    refreshTable();
}

function loadModal(tipe = 'form', modalid, message = null){
    if(tipe == 'notif'){
        $("#" + modalid + " .notif h3").text(message);
        $("#" + modalid).modal('show'); 
    }
    if(tipe == 'form')
        $("#" + modalid).modal('show');    

}