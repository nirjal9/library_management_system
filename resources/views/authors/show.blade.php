<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Author Details</h1>
        <p><strong>Name:</strong> {{ $author->name }}</p>
        <p><strong>Biography:</strong> {{ $author->biography ?? 'N/A' }}</p>
        <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>

        <hr>

        <h3>Reviews</h3>
        @if($author->reviews->isEmpty())
            <p>No reviews yet. Be the first to review this author!</p>
        @else
            @foreach($author->reviews as $review)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rating: {{ $review->rating }} / 5</h5>
                        <p>{{ $review->content }}</p>
                        <footer class="blockquote-footer">
                            Reviewed by {{ $review->user->name ?? 'Anonymous' }} on {{ $review->created_at->format('F j, Y') }}
                        </footer>
                    </div>
                </div>
            @endforeach
        @endif

        <h3 class="mt-5">Add a Review</h3>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('addReview', ['type' => 'author', 'id' => $author->id]) }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">Review</label>
                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5)</label>
                <select name="rating" id="rating" class="form-select" required>
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</body>
</html>
