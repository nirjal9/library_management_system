<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing History</title>
    <!-- Add Bootstrap for styling  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    
</head>
<body>
    
    <div class="container">
        <h1 class="my-4">Borrowing History</h1>

                <!-- Back to Dashboard Button -->
                <div class="mb-3">
                    <a href="{{ Auth::user()->role === 'admin' ? route('dashboard') : route('user.dashboard') }}" 
                       class="btn btn-primary">
                       Back to Dashboard
                    </a>
                </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Borrower</th>
                    <th>Borrowed At</th>
                    <th>Returned At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                <tr>
                    <td>{{ $borrow->id }}</td>
                    <td>{{ $borrow->book->title }}</td>
                    <td>{{ $borrow->user->name }}</td>
                    <td>{{ $borrow->borrowed_at }}</td>
                    <td>{{ $borrow->returned_at ?? 'Not Returned Yet' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Add pagination links -->
        <div>
            {{ $borrows->links('pagination::bootstrap-4') }}
        </div>
        
        </div>
    </div>
</body>
</html>
