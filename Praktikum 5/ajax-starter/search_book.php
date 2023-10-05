<?php include('header.php') ?>
<div class="row w-50 mx-auto mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Search Book Data</div>
            <div class="card-body">
                <form id="searchForm">
                    <div class="mb-3">
                        <label for="searchTitle" class="form-label">Search by Title:</label>
                        <input type="text" class="form-control" id="searchTitle" name="searchTitle" oninput="showBook(this.value)">
                    </div>
                </form>
                <br>
                <div id="detail_book"></div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php') ?>