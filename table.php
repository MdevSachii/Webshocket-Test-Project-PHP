<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>

<body class="max-w-7xl mx-auto py-8">
    <div class="flex flex-col">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden" id="table-container"></div>
            </div>
        </div>
    </div>
    <script>
         function createTable() {
            var table = document.createElement('table');
            table.id = 'students';
            table.className = 'min-w-full divide-y divide-gray-200'; // Tailwind classes

            var thead = document.createElement('thead');
            var tr = document.createElement('tr');

            ['First Name', 'Last Name', 'Email', 'Phone Number'].forEach(function(text) {
                var th = document.createElement('th');
                th.appendChild(document.createTextNode(text));
                tr.appendChild(th);
            });

            thead.appendChild(tr);
            table.appendChild(thead);

            var tbody = document.createElement('tbody');
            tbody.className = 'divide-y divide-gray-200';
            table.appendChild(tbody);

            document.getElementById('table-container').appendChild(table);
        }

        function addRow(firstName, lastName, email, phone) {
            var table = document.getElementById('students');
            var tbody = table.getElementsByTagName('tbody')[0];
            var tr = document.createElement('tr');

            [firstName, lastName, email, phone].forEach(function(text) {
                var td = document.createElement('td');
                td.className = 'text-center';
                td.appendChild(document.createTextNode(text));
                tr.appendChild(td);
            });

            tbody.appendChild(tr);
        }

        createTable();
        Pusher.logToConsole = true;

        var pusher = new Pusher('8da1dbd0b7aeee60873d', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('test_chat_app');
        channel.bind('my-event', function(data) {
            addRow(data['message']['firstName'], data['message']['lastName'], data['message']['email'], data['message']['phone']);
        });
    </script>
</body>

</html>