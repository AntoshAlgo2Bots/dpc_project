<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet" />

    <!-- Font Awesome Link -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />

    <!-- script -->
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        rel="stylesheet"
        href="https://unpkg.com/@material-tailwind/html@latest/styles/material-tailwind.css" />


    <!-- <link rel="stylesheet" href="./styles/addField.css"> -->
    <title>Add Field</title>
</head>

<body>
    <?php
    // include("./navForLogged.php");
   

    ?>




    <!-- <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"> -->
    <div class="flex justify-between">





        <div class="m-4">

            <h2 class="mb-4 text-3xl font-bold
    
    leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Category Management</h2>





            <div   class="mt-10 m-4">

                    <div id="oldMainCatArea">
                <label
                    class="block mb-2 font-bold text-x font-medium text-gray-900 dark:text-white"> Select category :
                </label>

                <div class="flex">

                    <br>
                    <select id="selectMainCat" class="py-3  px-4 pe-9 block   bg-gray-100 border-2 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">



                        <option selected="">Open this select menu</option>



                        <?php
                        include("./dbconnection/db.php");
                        // $con = mysqli_connect("localhost", "root", "Algo@123", "dpc_project") or die("connection failed");

                        $sql = "SELECT * FROM itemmastercategory; ";
                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {





                        ?>

                            <option value="<?php echo $row['categoryId']  ?>"> <?php echo $row['catagory_name']  ?> </option>


                        <?php
                        }
                        ?>




                    </select>


                    <button name="create-main-cat-btn" class="rounded-md bg-blue-600 py-1 px-3 border border-transparent text-center text-xs text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                        Create new ?
                    </button>



                </div>

                </div>

                <div id="newMainCatArea" class="mt-10 hidden m-4">





                    <label
                        class="block mb-2 font-bold text-x font-medium text-gray-900 dark:text-white"> Enter the  name of new category :
                    </label>

                    <div class="flex">

                        <br>
                        <input id="newMainCatName" class="py-3  px-4 pe-9 block   bg-gray-100 border-2 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" />


                        <button name="create_new_main_cat_btn" class="flex select-none ml-2 items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                            Create new +
                        </button>




                    </div>






                </div>




            </div>
            <div id="select_sub_category" class=" hidden mt-10 m-4">


                <label
                    class="block mb-2 font-bold text-x font-medium text-gray-900 dark:text-white"> Select sub category :
                </label>

                <div class="flex">

                    <br>
                    <select id="subcatselect" class="py-3  px-4 pe-9 block   bg-gray-100 border-2 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <option selected="">Open this select menu</option>
                    </select>


                    <button name="create_new_sub_cat" class="rounded-md bg-blue-600 py-1 px-3 border border-transparent text-center text-xs text-white transition-all shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                        Create new ?
                    </button>




                </div>






            </div>

            <div id="new_sub_cat_area" class="mt-10 hidden m-4">



                <script>
                    document.write(`Current selected category is ${ document.getElementById("selectMainCat").value  }`)
                </script>


                <label
                    class="block mb-2 font-bold text-x font-medium text-gray-900 dark:text-white"> Enter the name of sub category :
                </label>

                <div class="flex">

                    <br>
                    <input id="newSubCatName" class="py-3  px-4 pe-9 block   bg-gray-100 border-2 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" />


                    <button name="create_new_sub_cat_btn" class="flex select-none ml-2 items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                        Create new +
                    </button>




                </div>






            </div>


        </div>















        <div class="m-4">






                        
            <div id="mainCatTable" class="relative hidden flex flex-col overflow-auto    text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4  text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Categorys
                            </h5>
                            <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                                Total category is <span id="countoftotalcategorys"></span>
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
<!-- 
                            <button id="addMoreAttrubite-btn" data-dialog-target="dialog-md"
                                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                +
                                Add attribute
                            </button> -->
                        </div>
                    </div>

                </div>
                <div class="p-6 overflow-auto px-0" style="    max-height: 51vh;">
                    <table class="w-full max-h-full text-left table-auto overflow-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        S.no
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Categoy name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Action
                                    </p>
                                </th>
                               
                               
                               
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="mainCatTableTbody">
                            <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">1</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">name</p>
                                </td>
                                
                                
                                <td class="p-4 py-5">
                                    <p     class="block hover:underline  cursor-pointer font-medium text-sm text-red-800"><i m class="fa-solid fa-xmark"></i> </p>

                                    
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">

                    <div class="flex gap-2">

                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Done
                        </button>
                    </div>
                </div>
            </div>







            <div id="subCatTable" class="relative hidden flex flex-col overflow-auto    text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4  text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Categorys
                            </h5>
                            <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                                Total subcategory is :<span id="setTbodyLenOFsubcats"></span>
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
<!-- 
                            <button id="addMoreAttrubite-btn" data-dialog-target="dialog-md"
                                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                +
                                Add attribute
                            </button> -->
                        </div>
                    </div>

                </div>
                <div class="p-6 overflow-auto px-0" style="    max-height: 51vh;">
                    <table class="w-full max-h-full text-left table-auto overflow-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        S.no
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Sub Cat name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Main category name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Action
                                    </p>
                                </th>
                               
                               
                               
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="subCatTableTbody">
                            <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">1</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">name</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Main cat name</p>
                                </td>
                                
                                
                                <td class="p-4 py-5">
                                    <p     class="block hover:underline  cursor-pointer font-medium text-sm text-red-800"><i m class="fa-solid fa-xmark"></i> </p>

                                    
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">

                    <div class="flex gap-2">

                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Done
                        </button>
                    </div>
                </div>
            </div>











            <div id="attr_table_div" class="relative flex flex-col overflow-auto   hidden text-gray-700 bg-white shadow-md rounded-xl bg-clip-border">
                <div class="relative mx-4 mt-4  text-gray-700 bg-white rounded-none bg-clip-border">
                    <div class="flex items-center justify-between gap-8 mb-8">
                        <div>
                            <h5
                                class="block font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                                Attributes list
                            </h5>
                            <p class="block mt-1 font-sans text-base antialiased font-normal leading-relaxed text-gray-700">
                                All Attributes list here
                            </p>
                        </div>
                        <div class="flex flex-col gap-2 shrink-0 sm:flex-row">

                            <button id="addMoreAttrubite-btn" data-dialog-target="dialog-md"
                                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                +
                                Add attribute
                            </button>
                        </div>
                    </div>

                </div>
                <div class="p-6 overflow-auto px-0" style="    max-height: 51vh;">
                    <table class="w-full max-h-full text-left table-auto overflow-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        S.no
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        type
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        default value
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Place holder
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Dropdown
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="required_att_tbody">
                            <!-- <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">1</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">name</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Type</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Default</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Placeholder</p>
                                </td>

                            </tr> -->

                        </tbody>
                    </table>
                </div>
                <div class="flex items-center justify-between p-4 border-t border-blue-gray-50">

                    <div class="flex gap-2">

                        <button
                            class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Done
                        </button>
                    </div>
                </div>
            </div>







        </div>






    </div>


    <div
        data-dialog-backdrop="dialog-md"
        data-dialog-backdrop-close="true"
        class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
        <div
            data-dialog="dialog-md"
            class="relative m-4 p-4 w-2/5 rounded-lg bg-white shadow-sm">
            <div class="flex shrink-0 items-center pb-4 text-xl font-medium text-slate-800">
                Select Attributes
            </div>
            <div class="relative border-t border-slate-200 py-4 leading-normal ">



                <div class="flex">


                    <select id="requiredFieldsArea" class="py-2  cursor-pointer  px-4  block   bg-gray-100 border-2 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none">
                        <!-- <option selected="">Select the attribute</option>
                        <option value="color" >Color</option>
                        <option  value="lenth">Length</option> -->
                    </select>

                    <button id="addAttribute"
                        class="flex select-none ml-2 items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        + Add
                    </button>
                </div>




                <div>

                    <table id="newattrtable" class="w-full hidden max-h-full text-left table-auto overflow-auto min-w-max">
                        <thead>
                            <tr>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        S.no
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        name
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        type
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        default value
                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">
                                        Place holder
                                    </p>
                                </th>

                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>
                                <th class="p-4 border-b border-slate-300 bg-slate-50">
                                    <p class="block text-sm font-normal leading-none text-slate-500">

                                    </p>
                                </th>

                            </tr>
                        </thead>
                        <tbody id="field_att_tbody">
                            <!-- <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">1</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">name</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Type</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Default</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">Placeholder</p>
                                </td>

                            </tr> -->

                        </tbody>
                    </table>




                </div>








            </div>
            <div class="flex shrink-0 flex-wrap items-center pt-4 justify-end">
                <button data-dialog-close="true" class="rounded-md border border-transparent py-2 px-4 text-center text-sm transition-all text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Cancel
                </button>
                <button id="attrbute_confirm" data-dialog-close="true" class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    </div>





















    <button


        id="attfieldmappigarea-btn"
        data-dialog-target="dialog-lg"
        class="rounded-md hidden bg-slate-800 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
        Open Dialog LG
    </button>
    <div
        data-dialog-backdrop="dialog-lg"
        data-dialog-backdrop-close="true"
        class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
        <div
            data-dialog="dialog-lg"
            class="relative m-4 p-4 w-3/5 rounded-lg bg-white shadow-sm">
            <div id="headNameAttr" class="flex shrink-0 items-center pb-4 text-xl font-medium text-slate-800">

            </div>
            <div class="relative flex justify-between border-t border-slate-200 py-4 leading-normal text-slate-600 font-light">

                <div class=" bg-gray-100 pt-8">
                    <div class="bg-white p-3 max-w-md mx-auto">
                        <div class="text-center">
                            <h1 class="text-3xl font-bold">Add or remover attribute</h1>
                            <div class=" flex">
                                <input
                                    id="newAttributeNAmeAddInput"
                                    class="w-80 border-b-2 border-gray-500 text-black"
                                    type="text" placeholder="Enter attribute name" />
                                <button id="addNewRowToattributeListaddOrRemove-btn"
                                    class="ml-2 border-2 border-green-500 p-2 text-green-500 hover:text-white hover:bg-green-500 rounded-lg flex">
                                    <svg class="h-6 w-6" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="12" x2="15" y2="12" />
                                        <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                    <span>Add</span>
                                </button>
                            </div>
                        </div>
                        <div style="
                        
                                
    overflow: auto;
    max-height: 45vh;

                        " class="mt-8">

                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Attention!</strong>
                                <span class="block sm:inline">Please click on add list before submit .</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Close</title>
                                        <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                    </svg>
                                </span>
                            </div>
                            <ul id="attributeListaddOrRemove" class="overflow-auto">

                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                                <li class="p-2 rounded-lg">
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                            <input type="checkbox" class="h-6 w-6 " value="true" />
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">Old attributes</p>
                                        </div>
                                        <button
                                            class="flex text-red-500 border-2 border-red-500 p-2 rounded-lg">
                                            <svg class="h-6 w-6 text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10" />
                                                <line x1="15" y1="9" x2="9" y2="15" />
                                                <line x1="9" y1="9" x2="15" y2="15" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                    <hr class="mt-2" />
                                </li>
                            </ul>

                        </div>
                        <div class="mt-8">
                            <button
                                class="border-2 border-red-500 p-2 text-red-500">Reset list</button>
                            <button
                                id="addListToAttributeList-btn"
                                class="border-2 border-indigo-500 p-2 text-indigo-500 ml-4">Add list</button>
                        </div>
                    </div>
                </div>






                <div class="m-4">
                    <h1 class="text-3xl w-full font-bold">List attribute</h1>

                    <ul id="attrListShow" class=" flex  p-4 flex-wrap border border-gray-300 divide-y divide-gray-200 dark:divide-neutral-700">


                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            1. Profile
                        </li>
                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            2. Settings
                        </li>
                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            3. Newsletter
                        </li>
                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            4. Newsletter
                        </li>
                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            5. Newsletter
                        </li>
                        <li class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            6. Newsletter
                        </li>
                    </ul>
                </div>

            </div>

            <div class="flex shrink-0 flex-wrap items-center pt-4 justify-end">
                <button data-dialog-close="true" class="rounded-md border border-transparent py-2 px-4 text-center text-sm transition-all text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                    Cancel
                </button>
                <button id="savetheattrdata-btn" data-dialog-close="true" class="rounded-md bg-green-600 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-green-700 focus:shadow-none active:bg-green-700 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none ml-2" type="button">
                    Confirm
                </button>
            </div>
        </div>
    </div>












</body>







<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/categoryManagement.js"></script>
<script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>


</html>