<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> - Aplikasi Pembelajaran Genetika</title>
    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.css" rel="stylesheet">

    <!-- jQuery (pastikan dimuat sebelum Bootstrap & SweetAlert) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Background animasi DNA helix */
        .animated-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(45deg, #166835, #2e8b57);
            overflow: hidden;
        }

        .dna-helix {
            position: absolute;
            width: 100%;
            height: 100%;
            background: 
                repeating-linear-gradient(
                    90deg,
                    transparent 0px,
                    transparent 40px,
                    rgba(255,255,255,0.1) 40px,
                    rgba(255,255,255,0.1) 80px
                ),
                repeating-linear-gradient(
                    0deg,
                    transparent 0px,
                    transparent 40px,
                    rgba(255,255,255,0.1) 40px,
                    rgba(255,255,255,0.1) 80px
                );
            animation: moveHelix 20s linear infinite;
        }

        .dna-particles {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .particle {
            position: absolute;
            width: 8px;
            height: 8px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes moveHelix {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Card styling */
        .auth-card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        /* Form styling */
        .form-control, .form-select {
            border: 2px solid rgba(46,139,87,0.2);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2e8b57;
            box-shadow: 0 0 0 0.2rem rgba(46,139,87,0.25);
        }

        .input-group-text {
            background-color: #2e8b57;
            color: white;
            border: none;
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(45deg, #166835, #2e8b57);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(22,104,53,0.4);
        }

        /* Animated icon */
        .dna-icon {
            display: inline-block;
            font-size: 2em;
            color: #2e8b57;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body></body>
</body>
<div class="animated-background"></div>
</body>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan partikel DNA secara dinamis
    const background = document.querySelector('.animated-background');
    const particlesContainer = document.createElement('div');
    particlesContainer.className = 'dna-particles';
    
    // Tambahkan helix DNA
    const helix = document.createElement('div');
    helix.className = 'dna-helix';
    background.appendChild(helix);
    
    // Tambahkan partikel
    for(let i = 0; i < 50; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particle.style.left = Math.random() * 100 + '%';
        particle.style.top = Math.random() * 100 + '%';
        particle.style.animationDelay = Math.random() * 5 + 's';
        particlesContainer.appendChild(particle);
    }
    
    background.appendChild(particlesContainer);
});
</script>

</html>