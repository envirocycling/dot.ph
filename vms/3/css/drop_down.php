<link href="css/select2.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/select2.min.js"></script>
       <style>
            #supp_drop_down{
                width: 300px;
				text-align:center;
            }
			#plate{
                width: 120px;
				text-align:center;
            }
			#summary{
                width: 210px;
				text-align:center;
            }

        </style>
 <script>
	 $(document).ready(function () {
                $('#supp_drop_down').select2();
       });
	   $(document).ready(function () {
                $('#plate').select2();
       });
	    $(document).ready(function () {
                $('#summary').select2();
       });
 </script>