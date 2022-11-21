<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginador</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



</head>

<body>

    <div class="container" style="display: flex; flex-direction: column; align-items: center;">
        <div id="container__users">

        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><input type="button" class="page-link" value="Previous" id="previous"></li>
                <li class="page-item"><input type="button" class="page-link" value="Next" id="next"></li>
            </ul>
        </nav>
    </div>

    <script>
        var page = 1
        usersL()

        $('.page-link').click(function() {

            if (this.value == 'Previous') {
                page--
            } else if (this.value == 'Next') {
                page++
            }
            usersL()
        })

        function usersL() {
            $.ajax({
                url: `server.php?page=${page}`,
                dataType: 'JSON',
                success: function(data) {
                    users = data
                    console.log(users)
                    var claves = Object.keys(users);
                    var contentHTML = `
                        <table border="1">
                            <tr >
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Biografia</th>
                                <th>Genero</th>
                            </tr>`;
                    for (let i = 0; i < claves.length - 1; i++) {
                        //console.log(users[claves[i]])
                        contentHTML += `
                            <tr>
                                <td style="padding: 25px;">${users[claves[i]]['id']}</td>
                                <td style="padding: 25px;">${users[claves[i]]['name']}</td>
                                <td style="padding: 25px;">${users[claves[i]]['username']}</td>
                                <td style="padding: 25px;">${users[claves[i]]['email']}</td>
                                <td style="padding: 25px;">${(!users[claves[i]]['biography'])? "" : users[claves[i]]['biography']}</td>
                                <td style="padding: 25px;">${users[claves[i]]['gender']}</td>
                            </tr>`;

                    }
                    contentHTML += `
                    </table>`;
                    document.getElementById('container__users').innerHTML = contentHTML;
                }
            })
        }
    </script>