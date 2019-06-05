<head>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="alert/notie.css">
  <body></body>
<script src="alert/notie.js"></script>
    <script>
      notie.setOptions({
        colorSuccess: '#57BF57',
        colorWarning: '#D6A14D',
        colorError: '#E1715B',
        colorInfo: '#4D82D6',
        colorNeutral: '#A0A0A0',
        colorText: '#FFFFFF',
        animationDelay: 300,
        backgroundClickDismiss: true
      });

        notie.alert(1, 'Success! Please wait for the approval before the data will be updated.');
    </script>