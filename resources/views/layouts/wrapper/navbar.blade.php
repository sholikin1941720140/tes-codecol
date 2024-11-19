<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #1166d8">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: rgb(255, 255, 255)"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" role="button">
                <b id="clock" style="color: rgb(255, 255, 255)">
                </b> &nbsp;
                <i class="fas fa-clock" style="color: rgb(255, 255, 255)"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-controlsidebar-slide="true" style="cursor: pointer;color: rgb(255, 255, 255);"
                href="javascript:void(0);" onclick="logout()" role="button">
                <b>Keluar</b> &nbsp;
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>        
    </ul>
</nav>
<script>
    function logout() {
        $.ajax({
            url: '{{ url("/logout") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function(response) {
                if (response.success) { 
                    window.location.href = '{{ url("/") }}';
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan, silakan coba lagi.');
            }
        });
    }
</script>
<!-- /.navbar -->