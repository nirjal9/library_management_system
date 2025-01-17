<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST"> 
        @csrf<!--ensures security by adding a CSRF token to the form-->
        @method('PUT') <!-- This specifies the HTTP method for the update -->

        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ $book->title }}" required><br><br>

        <!-- Each input field uses the value attribute to pre-fill data-->
       {{-- $book->title is Blade's way of outputting dynamic data passed from the controller. --}}

       <label for="authors">Authors:</label>
       <input type="text" id="authors" name="authors" 
              value="{{ $book->authors->pluck('name')->join(', ') }}" required><br><br>

        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}" required><br><br>

        <label for="published_year">Published Year:</label>
        <input type="number" id="published_year" name="published_year" value="{{ $book->published_year }}" required><br><br>

        <div>
            <label for="publisher">Publisher</label>
            <select name="publisher_id" id="publisher">
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $book->description }}</textarea><br><br>

        <button type="submit">Update Book</button>
    </form>

    <a href="{{ route('books.index') }}">Back to Book List</a> 
</body>
</html>
