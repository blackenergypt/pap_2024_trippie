<link rel="icon" href="assets/images/lock.png" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/libs/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/libs/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/libs/toastify/toastify.min.css">
<link href="assets/css/style.css" rel="stylesheet">
<link href="assets/css/responsive.css" rel="stylesheet">
<script>
        // Função para mudar a imagem da bandeira
        function changeFlag(lang) {
            const flagButton = document.getElementById('flagButton');
            const flagImage = flagButton.querySelector('img');
            const flagText = flagButton.querySelector('span');

            switch (lang) {
                case 'en':
                    flagImage.src = 'assets/images/flags/en.svg';
                    flagText.textContent = 'English';
                    break;
                default:
                    flagImage.src = 'assets/images/flags/pt.svg';
                    flagText.textContent = 'Português';
                    break;
            }
        }
    </script>
    <style>
           /* mudar a cor da barra de scroll*/
      * {
    scrollbar-width: thin;
    scrollbar-color: #455561 #273049;
}
</style>