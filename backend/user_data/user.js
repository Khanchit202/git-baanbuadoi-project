var html, data;
getUser();
console.log(data);

function getUser(){

    $.ajax({
        url: 'user_data/get_user.php',
        type: 'POST',
        dataType: 'json',
        data: {},
    })
    .done(function(result) {
        data = result.data;
        html = '';
        for(var i=0; i<data.length; i++){
            html += `
            <tr>
                <td>${i+1}</td>
                <td>${data[i].userName}</td>
                <td>${data[i].userFName}</td>
                <td>${data[i].userLavelID}</td>
                <td>
                    <button onclick="openEditModal(${i})" class="btn btn-primary btn-sm"><i class="lni lni-pencil" style="padding: 5px;"></i></button>
                    <button onclick="delete_data(${i})" class="btn btn-danger btn-sm"><i class="lni lni-trash-can" style="padding: 5px;"></i></button>
                </td>
            </tr>
            `; 
        }

        $('#content').html(html);

    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}