<!DOCTYPE html>
<html>

<head>
  <title>Comment System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="js/comment_system.js" defer></script>
</head>

<body>
  <div class="container my-5">
    <h2 class="text-center mb-4">Comment System</h2>
    <form method="POST" id="comment_form">
      <div class="mb-3">
        <input type="email" name="comment_email" id="comment_email" class="form-control" placeholder="Enter Email" required>
      </div>
      <div class="mb-3">
        <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" required>
      </div>
      <div class="mb-3">
        <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5" required></textarea>
      </div>
      <input type="hidden" name="comment_id" id="comment_id" value="0">
      <button type="submit" name="submit" id="submit" class="btn btn-primary">Submit</button>
    </form>
    <div id="comment_message"></div>
    <div id="display_comment"></div>
  </div>

  <template id="reply_form_template">
    <form method="POST" class="reply_form">
      <div class="mb-3 mt-3">
        <input type="email" name="comment_email" class="form-control" placeholder="Enter Email" required>
      </div>
      <div class="mb-3">
        <input type="text" name="comment_name" class="form-control" placeholder="Enter Name" required>
      </div>
      <div class="mb-3">
        <textarea name="comment_content" class="form-control" placeholder="Enter Comment" rows="3" required></textarea>
      </div>
      <input type="hidden" name="comment_id" class="parent_comment_id" value="0">
      <button type="submit" class="btn btn-primary">Reply</button>
    </form>
  </template>
</body>

</html>