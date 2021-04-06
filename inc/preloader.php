 <style>
    #loader {
       position: fixed;
       z-index: 90000;
       width: 100%;
       min-height: 100vh;
       background: #fff;
       opacity: 1;
       visibility: visible;
       transition: all 0.3s ease-in-out;
    }

    #loader.fadeOut {
       opacity: 0;
       visibility: hidden;
    }

    .spinner {
       width: 40px;
       height: 40px;
       position: absolute;
       top: calc(50% - 20px);
       left: calc(50% - 20px);
       background-color: #333;
       border-radius: 100%;
       -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
       animation: sk-scaleout 1.0s infinite ease-in-out;
    }

    @-webkit-keyframes sk-scaleout {
       0% {
          -webkit-transform: scale(0)
       }

       100% {
          -webkit-transform: scale(1.0);
          opacity: 0;
       }
    }

    @keyframes sk-scaleout {
       0% {
          -webkit-transform: scale(0);
          transform: scale(0);
       }

       100% {
          -webkit-transform: scale(1.0);
          transform: scale(1.0);
          opacity: 0;
       }
    }
 </style>
 </head>

 <body class="app">
    <div id='loader'>
       <div class="spinner"></div>
    </div>

    <script>
       window.addEventListener('load', function load() {
          const loader = document.getElementById('loader');
          setTimeout(function() {
             loader.classList.add('fadeOut');
          }, 500);
       });
    </script>