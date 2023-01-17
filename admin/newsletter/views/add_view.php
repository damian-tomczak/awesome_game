<div class="form">
        <form action=".?action=newsletter/manage_news.php&do=add" method="POST">
            <p>
                <label>Title:</label>
                <input type="text" name="title" size="50">
            </p>
            <p>
                <label>Summary:</label>
                <textarea name="summary" rows="4" cols="50"></textarea>
            </p>
            <p>
                <label>Content:</label>
                <textarea name="content" rows="8" cols="50"></textarea>
            </p>
            <p>
                <label>Image url:</label>
                <input type="text" name="image_url" size="50">
            </p>
            <p>
                <label>Activated:</label>
                <input type="hidden" name="activated" value="0">
                <input type="checkbox" name="activated">
            </p>
            <p>
                <input type="submit" value="Add new news">
            </p>
        </form>
    </div>