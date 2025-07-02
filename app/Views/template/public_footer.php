</main>
        <footer>
            <p>&copy; <?= date('Y'); ?> My Website</p>
        </footer>
    </div> <!-- .container -->
    <script>
        // Like button functionality
        document.querySelector('.like-btn')?.addEventListener('click', function() {
            this.classList.toggle('liked');
            const icon = this.querySelector('i');
            const text = this.querySelector('span');

            if (this.classList.contains('liked')) {
                icon.className = 'fas fa-heart';
                text.textContent = 'Liked';
                this.style.borderColor = '#ef4444';
                this.style.color = '#ef4444';
            } else {
                icon.className = 'far fa-heart';
                text.textContent = 'Like';
                this.style.borderColor = '#e5e7eb';
                this.style.color = '#6b7280';
            }
        });

        // Share functions
        function shareToFacebook() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.querySelector('.article-title').textContent);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
        }

        function shareToTwitter() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.querySelector('.article-title').textContent);
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
        }

        function shareToWhatsApp() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.querySelector('.article-title').textContent);
            window.open(`https://wa.me/?text=${title} ${url}`, '_blank');
        }

        function shareToTelegram() {
            const url = encodeURIComponent(window.location.href);
            const title = encodeURIComponent(document.querySelector('.article-title').textContent);
            window.open(`https://t.me/share/url?url=${url}&text=${title}`, '_blank');
        }

        // Scroll to top
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Share button functionality
        document.querySelector('.share-btn')?.addEventListener('click', function() {
            const title = document.querySelector('.article-title').textContent;
            const url = window.location.href;

            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link artikel telah disalin ke clipboard!');
                });
            }
        });

        // Bookmark functionality
        document.querySelector('.bookmark-btn')?.addEventListener('click', function() {
            this.classList.toggle('bookmarked');
            const icon = this.querySelector('i');
            const text = this.querySelector('span');

            if (this.classList.contains('bookmarked')) {
                icon.className = 'fas fa-bookmark';
                text.textContent = 'Saved';
                this.style.borderColor = '#f59e0b';
                this.style.color = '#f59e0b';
            } else {
                icon.className = 'far fa-bookmark';
                text.textContent = 'Save';
                this.style.borderColor = '#e5e7eb';
                this.style.color = '#6b7280';
            }
        });
    </script>
</body>
</html>
