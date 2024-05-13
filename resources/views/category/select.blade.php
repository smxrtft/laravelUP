<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор категории</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Выберите категорию</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <select class="form-control" id="categorySelect">
                        @foreach($categories as $category)
                            <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="button" class="btn btn-primary" id="categorySelectButton">Выбрать</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('categorySelectButton').addEventListener('click', function() {
            var selectedCategoryId = document.getElementById('categorySelect').value;
            if (selectedCategoryId) {
                window.location.href = '/category/' + selectedCategoryId;
            }
        });
    </script>
</body>
</html>