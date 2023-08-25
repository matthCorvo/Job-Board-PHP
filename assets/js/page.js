const paginationLinks = document.querySelectorAll('.pagination .page-link');
paginationLinks.forEach(link => {
   link.addEventListener('click', function (event) {
      event.preventDefault();
      const page = this.getAttribute('href').replace('index.php?page', '');
      window.location.href = `/page${page}`;
   });
});