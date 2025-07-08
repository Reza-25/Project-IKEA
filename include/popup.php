<?php
function showLoginNotification($username) {
    ?>
    <div id="login-notification" class="login-notification">
        <div class="notification-cloud">
            <div class="icon-container">
                <div class="check-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="24px" height="24px">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                </div>
            </div>
            <div class="cloud-content">
                <p>Kamu berhasil masuk <strong><?= htmlspecialchars($username) ?></strong></p>
            </div>
        </div>
    </div>

    <style>
        /* Style untuk notifikasi login (tengah atas) */
        .login-notification {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            animation: floatDown 0.5s ease-out;
        }

        /* KOTAK AWAN YANG DIKECILKAN */
        .notification-cloud {
            position: relative;
            background: white;
            border-radius: 30px; /* Lebih kecil */
            padding: 10px 20px 10px 50px; /* Padding lebih kecil */
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid #81C784; /* Hijau muda */
            min-width: 220px; /* Lebih kecil */
            text-align: center;
            display: flex;
            align-items: center;
        }

        /* Container untuk ikon */
        .icon-container {
            position: absolute;
            left: 10px; /* Posisi disesuaikan */
            top: 50%;
            transform: translateY(-50%);
        }

        /* Lingkaran hijau muda (lebih kecil) */
        .check-icon {
            width: 28px; /* Lebih kecil */
            height: 28px; /* Lebih kecil */
            background-color: #81C784; /* Hijau muda */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Konten teks (lebih kecil) */
        .cloud-content {
            font-size: 13px; /* Lebih kecil */
            color: #333;
            flex: 1;
            padding: 4px 0;
        }

        .cloud-content p {
            margin: 0;
            line-height: 1.4;
        }

        @keyframes floatDown {
            from {
                transform: translate(-50%, -60px);
                opacity: 0;
            }
            to {
                transform: translate(-50%, 0);
                opacity: 1;
            }
        }

        /* Animasi centang */
        .check-icon svg {
            animation: checkScale 0.5s ease-in-out;
        }

        @keyframes checkScale {
            0% {
                transform: scale(0);
            }
            70% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
        .notification-cloud {
    background: #ffffff;
    background: linear-gradient(to right, #f8fff8 0%, #ffffff 30%, #ffffff 100%);
    border-radius: 50px;
    padding: 15px 30px 15px 70px;
    box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    border: none;
    position: relative;
    overflow: hidden;
}

.notification-cloud::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 60px;
    height: 100%;
    background: rgba(76, 175, 80, 0.1);
}
    </style>

    <script>
        // Otomatis hilangkan notifikasi setelah 3 detik dengan efek fade out
        setTimeout(function() {
            const notification = document.getElementById('login-notification');
            if (notification) {
                notification.style.transition = 'all 0.5s ease';
                notification.style.opacity = '0';
                notification.style.transform = 'translate(-50%, -20px)';
                
                // Hapus elemen setelah animasi selesai
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.parentNode.removeChild(notification);
                    }
                }, 500);
            }
        }, 3000);
    </script>
    <?php
}