document.addEventListener('DOMContentLoaded', (event) => {

  const commentForm = document.getElementById('comment_form');
  const commentMessage = document.getElementById('comment_message');
  const displayComment = document.getElementById('display_comment');

  let timesClicked = 0;


  // Function to handle form submission
  function submitForm(formElement) {
    const formData = new FormData(formElement);
    fetch('handlers/add_comment.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.error != '') {
        formElement.reset();
        commentMessage.innerHTML = data.error;
        document.getElementById('comment_id').value = '0';
        loadComments();
      }
    })
    .catch(error => console.error('Error:', error));
  }

  // Function to load comments from the server
  function loadComments() {
    fetch('handlers/fetch_comment.php', {
      method: 'POST'
    })
    .then(response => response.text())
    .then(data => displayComment.innerHTML = data)
    .catch(error => console.error('Error:', error));
  }

  // Event listener for new comment form submission
  commentForm.addEventListener('submit', (event) => {
    event.preventDefault();
    submitForm(commentForm);
  });

  // Event delegation for reply button click
  displayComment.addEventListener('click', (event) => {
    if (event.target.classList.contains('reply')) {
      if (timesClicked === 0) {
        const commentId = event.target.getAttribute('data-comment-id');
        const replyTemplate = document.getElementById('reply_form_template').content.cloneNode(true);
        const form = replyTemplate.querySelector('form');
        form.querySelector('.parent_comment_id').value = commentId;
        event.target.parentNode.appendChild(form);
        timesClicked++;
      }
    }
  });

  // Event delegation for reply form submission
  displayComment.addEventListener('submit', (event) => {
    if (event.target.classList.contains('reply_form')) {
      event.preventDefault();
      submitForm(event.target);
      event.target.remove(); // Remove the form after submission
      timesClicked = 0;
    }
  });

  // Load comments when the page is ready
  loadComments();
});
