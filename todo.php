<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Table with Add and Delete Row Feature</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #404E67;
            background: #F5F7FA;
            font-family: 'Open Sans', sans-serif;
        }

        .table-wrapper {
            width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }

        .table-title h2 {
            margin: 6px 0 0;
            font-size: 22px;
        }

        .table-title .add-new {
            float: right;
            height: 30px;
            font-weight: bold;
            font-size: 12px;
            text-shadow: none;
            min-width: 100px;
            border-radius: 50px;
            line-height: 13px;
        }

        .table-title .add-new i {
            margin-right: 4px;
        }

        table.table {
            table-layout: fixed;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table th:last-child {
            width: 100px;
        }

        table.table td a {
            cursor: pointer;
            display: inline-block;
            margin: 0 5px;
            min-width: 24px;
        }

        table.table td a.add {
            color: #27C46B;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #E34724;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table td a.add i {
            font-size: 24px;
            margin-right: -1px;
            position: relative;
            top: 3px;
        }

        table.table .form-control {
            height: 32px;
            line-height: 32px;
            box-shadow: none;
            border-radius: 2px;
        }

        table.table .form-control.error {
            border-color: #f50000;
        }

        table.table td .add {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            let i = 2;
            let flag = false;
            var actions = $(`<td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>`).html();
            var actions1 = $(`<td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>`).html();


            // showing data from database 

            const getUsers = () => {
                // <input type="text" class="form-control" name="name" id="name">
                // <input type="text" class="form-control" name="department" id="department">
                //make get request
                $.ajax({
                    url: "test1.php",
                    type: "get",
                    success: function(data) {
                        console.log(typeof data);
                        const data1 = JSON.parse(data);
                        console.log(data1.length);
                        for (i = 2; i <= data1.length + 1; i++) {
                            var index = $("table tbody tr:last-child").index();
                            console.log('useid',data1[i-2].userid);
                            var row = `<tr id="${data1[i-2].userid}">` +
                                `<td>${data1[i-2].name}</td>` +
                                `<td>${data1[i-2].email}</td>` +
                                // '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
                                '<td>' + actions1 + '</td>' +
                                '</tr>';
                            $("table").append(row);
                            $("table tbody tr").eq(index + i).find(".edit, .add").toggle();
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    }
                });
            }
            getUsers();


            // Append table with add row form on add new button click
            let userid = '';
            $(".add-new").click(function() {
                flag = false;
                $(this).attr("disabled", "disabled");
                var index = $("table tbody tr:last-child").index();
                userid = Date.now();
                var row = `<tr id="${userid}">` +
                    '<td><input type="text" class="form-control" name="name" id="name"></td>' +
                    '<td><input type="text" class="form-control" name="department" id="department"></td>' +
                    // '<td><input type="text" class="form-control" name="phone" id="phone"></td>' +
                    '<td>' + actions + '</td>' +
                    '</tr>';
                $("table").append(row);
                $("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
                $('[data-toggle="tooltip"]').tooltip();
            });
            // Add row on add button click
            $(document).on("click", ".add", function() {
                var empty = false;
                var input = $(this).parents("tr").find('input[type="text"]');
                console.log($(this).parents("tr")[0].id);
                let id = $(this).parents("tr")[0].id;
                console.log('id', id);
                input.each(function() {
                    if (!$(this).val()) {

                        $(this).addClass("error");
                        empty = true;
                    } else {
                        $(this).removeClass("error");
                    }
                });
                $(this).parents("tr").find(".error").first().focus();
                if (!empty) {
                    let i = 0;
                    let name = '';
                    let email = '';
                    input.each(function() {
                        $(this).parent("td").html($(this).val());

                        if (i == 0) {
                            name = $(this).val();
                            i = 1;
                        } else {
                            email = $(this).val();
                        }
                    });
                    console.log(name, email);
                    //make post request
                    if (flag==false) {
                        $.ajax({
                            url: "test1.php",
                            type: "post",
                            data: {
                                name,
                                email,
                                userid
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }else{
                        $.ajax({
                            url: "test1.php",
                            type: "post",
                            data: {
                                name,
                                email,
                                id
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        });
                    }

                    $(this).parents("tr").find(".add, .edit").toggle();
                    $(".add-new").removeAttr("disabled");
                }
            });
            // Edit row on edit button click
            $(document).on("click", ".edit", function() {
                flag = true;
                $(this).parents("tr").find("td:not(:last-child)").each(function() {
                    $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
                });
                $(this).parents("tr").find(".add, .edit").toggle();
                $(".add-new").attr("disabled", "disabled");
            });
            // Delete row on delete button click
            $(document).on("click", ".delete", function() {
                $(this).parents("tr").remove();
                console.log($(this).parents("tr")[0].id);
                let delid = $(this).parents("tr")[0].id;

                $.ajax({
                            url: "test1.php",
                            type: "post",
                            data: {
                                delid
                            },
                            success: function(data) {
                                console.log(data);
                            }
                        });

                $(".add-new").removeAttr("disabled");
            });
        });
    </script>
</head>

<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2> <b>Details</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>email</th>
                            <!-- <th>Phone</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                        <td>John Doe</td>
                        <td>Administration</td>
                        <td>(171) 555-2222</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Peter Parker</td>
                        <td>Customer Service</td>
                        <td>(313) 555-5735</td>
                        <td>
                            <a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>Fran Wilson</td>
                        <td>Human Resources</td>
                        <td>(503) 555-9931</td>
                        
                    </tr>       -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>