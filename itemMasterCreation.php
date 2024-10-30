<?php


include("./dbconnection/db.php");
// include("./navForLogged.php");

// var_dump(mysqli_get_connection_stats($con));


// $con = mysqli_connect("localhost", "root", "Algo@123", "dpc_project") or die("connection failed");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Item Master Form</title>
</head>

<body class="">
    <div id="create_section" class="mt-3 mx-5">
        <h1 class="text-center  uppercase text-3xl mb-3 font-bold">Item Master creation request</h1>
        <div class=" border border-gray-500 p-5 rounded-md">

            <div class="border border-gray-500 p-5 rounded-md mb-3">
                <div class="flex flex-wrap justify-between">
                    <div>


                        <div>
                            <label
                                class="w-20 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Code :
                            </label>
                            <input type="text" name="item_code" id="item_code" disabled
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-20 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Record ID :
                            </label>
                            <input type="text" name="record_id" id="record_id" disabled
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-20 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Name :
                            </label>
                            <input type="text" name="item_name" id="item_name"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-20 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Desc :
                            </label>
                            <input type="text" name="item_description"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-20 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Organization :
                            </label>
                            <input type="text" name="organization"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label
                                class="w-36 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Category :
                            </label>
                            <input type="text" name="item_category" disabled id="item_category"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-36 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item sub Category :
                            </label>
                            <input type="text" name="item_sub_category" disabled id="item_sub_category" 
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>

                        <div>
                            <label
                                class="w-36 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item sub sub Category :
                            </label>
                            <input type="text" name="item_sub_sub_category"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-36 inline-block font-bold text-xs font-medium text-gray-900 dark:text-white">Finish / Raw Meterial :
                            </label>
                            <select id="finish_raw_material" name="finish_raw_material"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 w-44 focus:border-blue-500 pl-3 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose One</option>
                                <option value="finish_good">Finish Goods</option>
                                <option value="row_item">Raw Material</option>
                            </select>
                        </div>
                    </div>

                    <div class="">
                        <div>
                            <label
                                class="w-28 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Starting Date :
                            </label>
                            <input type="date" name="item_starting_date"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div>
                            <label
                                class="w-28 inline-block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">Item Ending Date :
                            </label>
                            <input type="date" name="item_ending_date"
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <!-- <div class="">
                            <label
                                class="w-28 inline-block font-bold text-xs font-medium text-gray-900 dark:text-white">Item Status :
                            </label>
                            <select id="countries" name="item_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-md focus:ring-blue-500 w-44 focus:border-blue-500 pl-3 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 mb-3 dark:focus:border-blue-500">
                                <option selected disabled>Choose One</option>
                                <option  value="Finish Goods">Active</option>
                                <option value="Raw Material">Un-Active</option>
                            </select>
                        </div> -->
                        <div class="flex">
                            <label
                                class="w-28 inline-block mb-1 font-bold text-xs font-medium text-gray-900 dark:text-white">Upload Image :
                            </label>
                            <label for="dropzone-file"
                                class="flex flex-col items-center w-44 justify-center h-7 p-2 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 ml-1 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <p class=" text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span>
                                </div>
                                <input id="dropzone-file" type="file" name="itemImage" class="hidden" />
                            </label>
                        </div>
                    </div>

                    <div class="border border-gray-600 w-40 h-36 rounded-md ">
                        <img class="w-40 h-36 rounded-md" id="uploaded_file_path" src="" alt="image preview">
                    </div>
                </div>
            </div>

            <!-- main category -->
            <div class="border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap justify-between text-sm font-medium text-center" id="default-styled-tab"
                    data-tabs-toggle="#default-styled-tab-content"
                    data-tabs-active-classes="text-gray-600 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-500 border-gray-600 dark:border-gray-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">






                    <?php

                    $sql = "SELECT * FROM dpc_project.itemmastercategory; ";
                    $result = mysqli_query($con, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                        <li class="me-2" role="presentation">
                            <button
                                onclick="setRequireFieldsFromCategory(event)"
                                cat-id="<?php echo $row["categoryId"] ?>"
                                cat-name="<?php echo $row["catagory_name"] ?>"
                                class="inline-block py-1 px-7 border-t border-r focus:outline-none border-l border-gray-500 rounded-t-lg"><?php echo $row["catagory_name"]   ?></button>

                        </li>

                    <?php

                    }
                    ?>

                </ul>
            </div>




            <!-- sub category -->

            <div id="default-styled-tab-content">
                <div class=" p-4 border-x border-b border-gray-600 rounded-b-lg bg-gray-50 dark:bg-gray-800"
                    id="styled-profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div id="sub-cat-area-field" class="flex gap-x-20">
                      
                    </div>

                    <div class="item border border-gray-700 p-5 mt-4 rounded-lg" ">






                        <div   id="sub-cat-attr-area" class=" flex flex-wrap gap-x-14">

                        
                        </div>
                    
                    
                        

                    
                    </div>




                    
                </div>


                

            </div>


            
            <div>

            <center>

                <button type="button" id="save-item" onclick="saveItemDataToTemp()" class="text-white mt-3 bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Submit</button>
            </center>

</div>


        </div>












   
   
        </div>
    </div>
    </div>



    <script src="./js/jquery-3.7.1.min.js"></script>

    <script>
        document.getElementById('dropzone-file').addEventListener('change', function(event) {
    const file = event.target.files[0]; // Get the file input
    if (file) {
        const reader = new FileReader(); // Create a FileReader object

        reader.onload = function(e) {
            const imagePreview = document.getElementById('uploaded_file_path');
            imagePreview.src = e.target.result; // Set the src of the img to the file content
        }

        reader.readAsDataURL(file); // Read the file as a DataURL (base64 string)
    }
});

    </script>
</body>



<script src="./js/itemMasterCreation.js"></script>
</html>