$("#"+formid).ajaxForm({
    success: function(data, status, xhr, element){
        $("#"+modalid).modal('hide');
        $("#" + formid + " input[name = '_method']").val('POST');
        $("#" + formid).prop('action', path + '/ujian/');
        $("#" + formid + " #matkul").val('');
        $("#" + formid + " #dosen").val('');
        $("#" + formid + " #soal").val('');
        $("#" + formid + " #keterangan").val('');
        loadModal('notif','modal-notif-tambah-data', data.message)
        refreshTable();
    },
});

function refreshTable(){
    $("#table-data-ujian tbody tr").remove();
    var row = null;
    var tbody = $("#table-data-ujian tbody");
    var data = null
    var settings = {
        "async": false,
        "crossDomain": true,
        'dataType': 'json',
        "url": window.location.origin + '/api/getAll',
        "method": "GET",
    }   
    data = $.ajax(settings).done(function (response) {
        return response;
    });
    console.log(data);
    data = data.responseJSON;
    // keys = Object.keys(data.responseJSON);
    console.log(data.length);
    
    for (let i = 0; i < data.length; i++) {
        if(!data[i].updated_at)
            data[i].updated_at = '';
        else
            data[i].updated_at = data[i].updated_at.substr(0, 10);
        
        data[i].created_at = data[i].created_at.substr(0, 10);
        row += '<tr>' +
                    '<td>' + data[i].id + '</td>' +
                    '<td>' + 
                        '<div class="dropdown">' +
                            '<a class="dropdown-toggle" style="color: black; text-decoration: none" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                data[i].nama_mk +
                            '</a>' +
                            '<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">' +
                                '<span class="dropdown-item tool-edit" data-id = "' + data[i].id + '" style="cursor: pointer">' + "Edit" + '</span>' +
                                '<span class="dropdown-item tool-hapus" data-id = "' + data[i].id + '" style="cursor: pointer">' + "Hapus" + '</span>' +
                            '</div>' +
                        '</div>'+
                    '</td>' +
                    '<td>' + data[i].dosen + '</td>' +
                    '<td>' + data[i].jumlah_soal + '</td>' +
                    '<td>' + data[i].keterangan + '</td>' +
                    '<td>' + data[i].created_at + '</td>' +
                    '<td>' + data[i].updated_at + '</td>' +
                '</tr>';
    }
    
    if(row)
        tbody.append(row);

    $(".tool-edit").click(editHandle);
    $(".tool-hapus").click(hapusHandle);
    
}