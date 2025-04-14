<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WorkSync</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
        }

        th {
            text-align: center;
        }

        td {
            text-align: left;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        @media print {
            /* Hides elements that are not needed in print */
            .no-print {
                display: none;
            }

            body {
                font-size: 12px;
            }

            table th, table td {
                font-size: 12px;
            }
        }
    </style>
</head>
<body onload="window.print()" onafterprint="window.history.back()">
    @yield('content')
</body>
</html>