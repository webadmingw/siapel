<form action="/news/edit/<?= $news['id'] ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $news['title'] ?>">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control" id="content" name="content"><?= $news['content'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        <img src="/public/images/<?= $news['image'] ?>" alt="<?= $news['title'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
