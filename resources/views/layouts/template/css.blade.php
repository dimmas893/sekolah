  <!-- General CSS Files -->
  {{-- <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
      integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" /> --}}
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="/css/jquery.toast.css">
  <style>
      .load-wrapp {
          float: left;
          width: 100px;
          height: 100px;
          margin: 0 10px 10px 0;
          padding: 20px 20px 20px;
          border-radius: 5px;
          text-align: center;
          background-color: #d8d8d8;
      }

      .load-wrapp p {
          padding: 0 0 20px;
      }

      .load-wrapp:last-child {
          margin-right: 0;
      }

      .line {
          display: inline-block;
          width: 15px;
          height: 15px;
          border-radius: 15px;
          background-color: #4b9cdb;
      }

      .ring-1 {
          width: 10px;
          height: 10px;
          margin: 0 auto;
          padding: 10px;
          border: 7px dashed #4b9cdb;
          border-radius: 100%;
      }

      .ring-2 {
          position: relative;
          width: 45px;
          height: 45px;
          margin: 0 auto;
          border: 4px solid #4b9cdb;
          border-radius: 100%;
      }

      .ball-holder {
          position: absolute;
          width: 12px;
          height: 45px;
          left: 17px;
          top: 0px;
      }

      .ball {
          position: absolute;
          top: -11px;
          left: 0;
          width: 16px;
          height: 16px;
          border-radius: 100%;
          background: #4282b3;
      }

      .letter-holder {
          padding: 16px;
      }

      .letter {
          float: left;
          font-size: 14px;
          color: #777;
      }

      .square {
          width: 12px;
          height: 12px;
          border-radius: 4px;
          background-color: #4b9cdb;
      }

      .spinner {
          position: relative;
          width: 45px;
          height: 45px;
          margin: 0 auto;
      }

      .bubble-1,
      .bubble-2 {
          position: absolute;
          top: 0;
          width: 25px;
          height: 25px;
          border-radius: 100%;
          background-color: #4b9cdb;
      }

      .bubble-2 {
          top: auto;
          bottom: 0;
      }

      .bar {
          float: left;
          width: 15px;
          height: 6px;
          border-radius: 2px;
          background-color: #4b9cdb;
      }

      /* =Animate the stuff
------------------------ */
      .load-1 .line:nth-last-child(1) {
          animation: loadingA 1.5s 1s infinite;
      }

      .load-1 .line:nth-last-child(2) {
          animation: loadingA 1.5s 0.5s infinite;
      }

      .load-1 .line:nth-last-child(3) {
          animation: loadingA 1.5s 0s infinite;
      }

      .load-2 .line:nth-last-child(1) {
          animation: loadingB 1.5s 1s infinite;
      }

      .load-2 .line:nth-last-child(2) {
          animation: loadingB 1.5s 0.5s infinite;
      }

      .load-2 .line:nth-last-child(3) {
          animation: loadingB 1.5s 0s infinite;
      }

      .load-3 .line:nth-last-child(1) {
          animation: loadingC 0.6s 0.1s linear infinite;
      }

      .load-3 .line:nth-last-child(2) {
          animation: loadingC 0.6s 0.2s linear infinite;
      }

      .load-3 .line:nth-last-child(3) {
          animation: loadingC 0.6s 0.3s linear infinite;
      }

      .load-4 .ring-1 {
          animation: loadingD 1.5s 0.3s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
      }

      .load-5 .ball-holder {
          animation: loadingE 1.3s linear infinite;
      }

      .load-6 .letter {
          animation-name: loadingF;
          animation-duration: 1.6s;
          animation-iteration-count: infinite;
          animation-direction: linear;
      }

      .l-1 {
          animation-delay: 0.48s;
      }

      .l-2 {
          animation-delay: 0.6s;
      }

      .l-3 {
          animation-delay: 0.72s;
      }

      .l-4 {
          animation-delay: 0.84s;
      }

      .l-5 {
          animation-delay: 0.96s;
      }

      .l-6 {
          animation-delay: 1.08s;
      }

      .l-7 {
          animation-delay: 1.2s;
      }

      .l-8 {
          animation-delay: 1.32s;
      }

      .l-9 {
          animation-delay: 1.44s;
      }

      .l-10 {
          animation-delay: 1.56s;
      }

      .load-7 .square {
          animation: loadingG 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
      }

      .load-8 .line {
          animation: loadingH 1.5s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
      }

      .load-9 .spinner {
          animation: loadingI 2s linear infinite;
      }

      .load-9 .bubble-1,
      .load-9 .bubble-2 {
          animation: bounce 2s ease-in-out infinite;
      }

      .load-9 .bubble-2 {
          animation-delay: -1s;
      }

      .load-10 .bar {
          animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
      }

      @keyframes loadingA {
          0 {
              height: 15px;
          }

          50% {
              height: 35px;
          }

          100% {
              height: 15px;
          }
      }

      @keyframes loadingB {
          0 {
              width: 15px;
          }

          50% {
              width: 35px;
          }

          100% {
              width: 15px;
          }
      }

      @keyframes loadingC {
          0 {
              transform: translate(0, 0);
          }

          50% {
              transform: translate(0, 15px);
          }

          100% {
              transform: translate(0, 0);
          }
      }

      @keyframes loadingD {
          0 {
              transform: rotate(0deg);
          }

          50% {
              transform: rotate(180deg);
          }

          100% {
              transform: rotate(360deg);
          }
      }

      @keyframes loadingE {
          0 {
              transform: rotate(0deg);
          }

          100% {
              transform: rotate(360deg);
          }
      }

      @keyframes loadingF {
          0% {
              opacity: 0;
          }

          100% {
              opacity: 1;
          }
      }

      @keyframes loadingG {
          0% {
              transform: translate(0, 0) rotate(0deg);
          }

          50% {
              transform: translate(70px, 0) rotate(360deg);
          }

          100% {
              transform: translate(0, 0) rotate(0deg);
          }
      }

      @keyframes loadingH {
          0% {
              width: 15px;
          }

          50% {
              width: 35px;
              padding: 4px;
          }

          100% {
              width: 15px;
          }
      }

      @keyframes loadingI {
          100% {
              transform: rotate(360deg);
          }
      }

      @keyframes bounce {

          0%,
          100% {
              transform: scale(0);
          }

          50% {
              transform: scale(1);
          }
      }

      @keyframes loadingJ {

          0%,
          100% {
              transform: translate(0, 0);
          }

          50% {
              transform: translate(80px, 0);
              background-color: #f5634a;
              width: 25px;
          }
      }
  </style>
