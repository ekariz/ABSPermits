<table id="users-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
        <thead>
            <tr>
                <th>user name</th>
                <th>Salary</th>
                <th>Age</th>
            </tr>
        </thead>
        <thead>
        <tr>
            <td><input type="text" data-column="0"  class="search-input-text"></td>
            <th><input type="text" data-column="1"  class="search-input-text"></td>
            <td>
                <select data-column="2"  class="search-input-select">
                    <option value="">(Select a range)</option>
                    <option value="19-30">19 - 30</option>
                    <option value="31-66">31 - 66</option>
                </select>
            </td>
        </tr>
    </thead>
</table>

<script type="text/javascript" language="javascript" >
        var dataTable = $('#users-grid').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                url :"Grid/data1", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $(".users-grid-error").html("");
                    $("#users-grid").append('<tbody class="users-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#users-grid_processing").css("display","none");

                }
            }
        } );
</script>
