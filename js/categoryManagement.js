$("#selectMainCat").on("change", function () {
  console.log(this.value);

  let id = this.value;

  data = {
    categoryFields: "categoryFields",
    catId: id,
  };

  $.ajax({
    url: "ajaxItemMaster.php",
    method: "GET",
    data,
    dataType: "json",
    success: function (data) {
      // document.getElementById("sub_catArea").innerText = ""
      let resData = data.data;

      if (data.success) {
        console.log(resData);

        $("#select_sub_category").slideDown(1000);

        $("#subcatselect").html("");

        $("#subcatselect").append(`
                
    
            <option selected disabled>Select</option>
            
            
            `);

        Object.keys(resData).forEach((element) => {
          $("#subcatselect").append(`
                
    
                <option value='${resData[element][0].SubcatId}'>${element}</option>
                
                
                `);
        });
      }

      // addSubCatFields(resData)
    },
    error: function (error) {
      console.log(error);
    },
  });
});

$("#subcatselect").on("change", function () {
  let sub_id = this.value;

  let data = {
    sub_id: sub_id,
    getRequireAttrs: "getRequireAttrs",
  };

  $.get(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      console.log(data);

      if (data.success) {
        console.log(data.data);

        $("#required_att_tbody").html("");
        $("#attr_table_div").slideDown(1000);

        data.data.forEach((row, index) => {
          index++;

          $("#required_att_tbody").append(`
                            

                             <tr class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">${index}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${row.name}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${row.type}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${row.default_value}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${row.placeholder}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${row.dropdown}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p  attr_name="${row.name}" attr_id='${row.attr_id}' name="editAttrField" class="block hover:underline   cursor-pointer font-medium text-sm text-blue-800">Edit </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p   data-dialog-target="dialog-md"  class="block hover:underline  cursor-pointer font-medium text-sm text-slate-800"><i m class="fa-solid fa-xmark"></i> </p>

                                    
                                </td>

                            </tr>
                            
                            
                            
                            `);
        });
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
});

$("#addAttribute").on("click", function () {
  let fields_name = $("#requiredFieldsArea").val();

  let tbody = $("#field_att_tbody")[0];
  let lenoftbody = tbody.querySelectorAll("tr").length;
  lenoftbody++;

  // $("#field_att_tbody").html("")

  $("#newattrtable").slideDown(1000);

  $("#field_att_tbody").append(`
    
    
    


     <tr class="hover:bg-slate-50 border-b border-slate-200">
      <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800"> 
                                     <input  id="default-checkbox" attr-value="${fields_name}"type="checkbox" value="" class="w-4 h-4 text-black-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue -600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    
                                    </p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block font-semibold text-sm text-slate-800">${lenoftbody}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${fields_name}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">txt</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">null</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${fields_name}</p>
                                </td>
                               

                            </tr>


    
    
    
    
    
    `);

  $(`#requiredFieldsArea option[value="${fields_name}"]`).remove();
});

$("#addMoreAttrubite-btn").click(function (e) {
  e.preventDefault();

  let subCatId = $("#subcatselect").val();

  $("#field_att_tbody").html("");

  console.log("CLicked on addMoreAttrubite-btn");

  let data = {
    getAllAttrubte: "getAllAttrubte",
    sub_id: subCatId,
  };

  $.getJSON(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      console.log(data);

      if (data.success) {
        $("#requiredFieldsArea").html("");
        $("#newattrtable").slideUp();

        let resData = data.data;

        $("#requiredFieldsArea").append(`

            <option selected  disabled  >select</option>
          
            `);

        resData.forEach((name) => {
          console.log(name);

          $("#requiredFieldsArea").append(`

              <option  class="cursor-pointer" value="${name.name}" >${name.name}</option>
            
              `);
        });
      }
    }
  ).fail((error) => {
    console.log(error);
  });
});

$("#attrbute_confirm").on("click", function (e) {
  let trows = $("#field_att_tbody")[0].querySelectorAll("tr");

  let sub_Cat_id = $("#subcatselect").val();

  console.log(sub_Cat_id);

  let chcked_box = $("#field_att_tbody")[0].querySelectorAll(
    "tr input[type='checkbox']:checked"
  );

  let checkedRowData = [];

  let checkedRow = trows.forEach((row) => {
    let checkbox = row.querySelector("input[type='checkbox']");

    if (checkbox.checked) {
      let attr_name = $(checkbox).attr("attr-value");

      checkedRowData.push(attr_name);
    }
  });

  let data = {
    checkedRowData: checkedRowData,
    addNewAttributesToSubCat: "addNewAttributesToSubCat",
    sub_Cat_id: sub_Cat_id,
  };

  $.post(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      console.log(data);
      if (data.success) {
        alert("Data fetched successfully ");
      } else {
        alert(
          "something went wrong please check network connection or refresh the page"
        );
      }
    },
    "json"
  ).fail((error) => {
    alert(
      "something went wrong please check network connection or refresh the page"
    );
    console.log(error);
  });

  console.log(checkedRowData);
});

$("#required_att_tbody").on("click", "p[name='editAttrField']", function () {
  console.log(this);

  $("#headNameAttr").text($(this).attr("attr_name"));

  let attr_id = $(this).attr("attr_id");

  $("#attributeListaddOrRemove").attr("current-attr-id", attr_id);
  let data = {
    getAllAttributeByFieldName: "getAllAttributeByFieldName",
    attr_id: attr_id,
  };

  $.get(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      console.log(data);
      if (data.success) {
        // alert("Data fetched successfully ");

        let resData = data.data;

        $("#attributeListaddOrRemove").html("");
        $("#attrListShow").html("");

        resData.forEach((element, index) => {
          index++;

          $("#attributeListaddOrRemove").append(`
                          <li class="p-2 rounded-lg" attr_name = ${element.description}>
                                    <div class="flex align-middle flex-row justify-between">
                                        <div class="p-2">
                                           ${index}
                                        </div>
                                        <div class="p-2">
                                            <p class="text-lg text-black">${element.description}</p>
                                        </div>
                                        <button
                                        name="self_remove"
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

                
                
                `);

          $("#attrListShow").append(`
            
                <li attr_name="${element.description}" class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                                        ${index}. ${element.description}
                                    </li>
            
                
                `);
        });
      } else {
        alert(
          "something went wrong please check network connection or refresh the page"
        );
      }
    },
    "json"
  ).fail((error) => {
    alert(
      "something went wrong please check network connection or refresh the page"
    );
    console.log(error);
  });

  $("#attfieldmappigarea-btn").click();
});

$("#addListToAttributeList-btn").on("click", function () {
  let rowlis = $("#attributeListaddOrRemove")[0].querySelectorAll("li");

  let listCheckedAttrs = [];

  rowlis.forEach((row) => {
    let checkbox = row.querySelector("input[type='checkbox']");

    // if (checkbox.checked) {
    listCheckedAttrs.push($(row).attr("attr_name"));
    // }attrbute_confirm
  });

  console.log(listCheckedAttrs);

  $("#attrListShow").html("");

  listCheckedAttrs.forEach((name, index) => {
    index++;
    $("#attrListShow").append(`

    <li attr_name="${name}" class="inline-flex items-center m-3 gap-x-2 py-3 text-sm font-medium text-gray-800 dark:text-white">
                            ${index}. ${name}
                        </li>

    
    `);
  });
});

$("#addNewRowToattributeListaddOrRemove-btn").on("click", function () {
  let att_name = $("#newAttributeNAmeAddInput").val();

  let length = $("#attributeListaddOrRemove")[0].querySelectorAll("li").length;

  $("#attributeListaddOrRemove").append(`
    <li class="p-2 rounded-lg" attr_name = ${att_name}>
              <div class="flex align-middle flex-row justify-between">
                  <div class="p-2">
                      
                      ${length}
                  </div>
                  <div class="p-2">
                      <p class="text-lg text-black">${att_name}</p>
                  </div>
                  <button
                  name="self_remove"
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



`);
});

$("#attributeListaddOrRemove").on(
  "click",
  "button[name='self_remove']",
  function () {
    let line = this.closest("li");

    // console.log(line);

    if (window.confirm("Confirm remove")) {
      $(line).fadeOut(1000);
      $(line).remove();
    }
  }
);

$("#savetheattrdata-btn").click(function (e) {
  if (window.confirm("Are you sure ?")) {
    let validAttRnames = [];

    let rowLis = $("#attrListShow")[0].querySelectorAll("li");

    rowLis.forEach((row) => {
      validAttRnames.push($(row).attr("attr_name"));
    });

    console.log(validAttRnames);

    let attr_id = $("#attributeListaddOrRemove").attr("current-attr-id");

    let isDropDown = "";

    if (validAttRnames.length > 0) {
      isDropDown = "yes";
    } else {
      isDropDown = "no";
    }
    let data = {
      validAttRnames: validAttRnames,
      addingNewAttributes: "addingNewAttributes",
      attr_id: attr_id,
      isDropDown: isDropDown,
    };

    // console.log(validAttRnames.length);

    console.log(isDropDown);

    $.post(
      "./phpAjax/categoryManagentAjax.php",
      data,
      function (data, textStatus, jqXHR) {
        if (data.success) {
          alert("Success fully creatdd");

          console.log(data);
        }
      },
      "json"
    ).fail((error) => {
      console.log(error);
    });
  }
});

const setRowToSubCategory = () => {
  $("#attr_table_div").slideUp(1000);
  let data = {
    getAllSubCatName: "getAllSubCatName",
  };

  $.getJSON(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data.success) {
        let resData = data.data;
        console.log(data);

        $("#subCatTableTbody").html("");

        resData.forEach((element, index) => {
          index++;

          $("#subCatTableTbody").append(`
                


                   <tr sub-id="${element.subCatId}" class="hover:bg-slate-50 border-b border-slate-200">
                                <td class="p-4 py-5">
                                     <p class="block font-semibold text-sm text-slate-800">${index}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${element.name}</p>
                                </td>
                                <td class="p-4 py-5">
                                    <p class="block text-sm text-slate-800">${element.catagory_name}</p>
                                </td>
                                
                                
                                <td class="p-4 py-5">
                                    <p    name='remove-sub'   sub-id="${element.subCatId}"   class="block hover:underline  cursor-pointer font-medium text-sm text-red-800"><i m class="fa-solid fa-xmark"></i> </p>

                                    
                                </td>
                            </tr>


                
                `);
        });

        $("#setTbodyLenOFsubcats").text(resData.length);
      }
    }
  ).fail((error) => {
    console.log(error);
  });
};
$("button[name='create_new_sub_cat']").click(function (e) {
  e.preventDefault();

  if (window.confirm("Are you sure to create new sub category ")) {
    console.log("clicked on ");

    setRowToSubCategory();

    $("#select_sub_category").slideUp(1000, function () {
      $("#new_sub_cat_area").slideDown();
      $("#subCatTable").slideDown();
    });
  }
});

$("button[name='create_new_sub_cat_btn']").click(function (e) {
  e.preventDefault();

  let maincatId = $("#selectMainCat").val();
  let newSubCatName = $("#newSubCatName").val();

  let data = {
    mainCatId: maincatId,
    newSubName: newSubCatName,
    createNewSubCat: "createNewSubCat",
  };

  $.post(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data.success) {
        alert(
          `new sub category are created success fully id is ${data.return_id}`
        );

        setRowToSubCategory();
        console.log(data);
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });

  console.log(data);
});

const addRowToMainCatTable = (resData) => {
  $("#attr_table_div").slideUp(1000);
  let data = {
    getAllMAinCatName: "getAllMAinCatName",
  };

  $.getJSON(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data.success) {
        let resData = data.data;

        console.log(data);

        $("#mainCatTableTbody").html("");

        $(countoftotalcategorys).text(resData.length)
        resData.forEach((element, index) => {
          index++;

          $("#mainCatTableTbody").append(`

         <tr cat-id="${element.categoryId}" class="hover:bg-slate-50 border-b border-slate-200">
                            <td class="p-4 py-5">
                                <p class="block font-semibold text-sm text-slate-800">${index}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="block text-sm text-slate-800">${element.catagory_name}</p>
                            </td>
                            
                            
                          
                            <td class="p-4 py-5">
                                <p  name="remove-cat" cat-id="${element.categoryId}"   class="block hover:underline  cursor-pointer font-medium text-sm text-red-800"><i m class="fa-solid fa-xmark"></i> </p>

                                
                            </td>
                        </tr>
        

        
        `);
        });
      }

      console.log(data);
    }
  ).fail((error) => {
    console.groupEnd();
    error;
  });
};

$("button[name='create-main-cat-btn']").click(function (e) {
  $("#newMainCatArea").slideDown(1000);
  $("#mainCatTable").slideDown(1000);
  $("#oldMainCatArea").slideUp(1000);
  $("#select_sub_category").slideUp(1000);
  $("#attr_table_div").slideUp(1000);

  addRowToMainCatTable();
});

$("button[name='create_new_main_cat_btn']").click(function (e) {
  let newCatName = $("#newMainCatName").val();

  let data = {
    createdNewCategory: "createdNewCategory",
    newCatName: newCatName,
  };

  $.post(
    "./phpAjax/categoryManagentAjax.php",
    data,
    function (data, textStatus, jqXHR) {
      if (data.success) {
        alert(
          `new Main category is created sussfully  id is ${data.return_id}`
        );

        console.log(data);

        $("#newMainCatArea").slideUp(1000);
        $("#oldMainCatArea").slideDown(1000);
        $("#subCatTable").slideUp(1000);
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
});




$("#subCatTableTbody").on("click", "p[name='remove-sub']", function () {
  let currentTr = this.closest("tr");
  let sub_id = $(currentTr).attr("sub-id");
  console.log(currentTr);

  if (window.confirm("Are you sure to remove sub category")) {
    if (
      window.confirm(
        "Are you still  want to remove sub category post your action cannot be rollback"
      )
    ) {
      console.log(sub_id);

      let data = {
        removeSubCategory: "removeSubCategory",
        sub_id: sub_id,
      };

      $.post(
        "./phpAjax/categoryManagentAjax.php",
        data,
        function (data, textStatus, jqXHR) {
          console.log(data);
          if (data.success) {
            alert("Row success");
            setRowToSubCategory();
          }
        },
        "json"
      ).fail((error) => {
        console.log(error);
      });
    }
  }
});

$("#mainCatTable").on("click", "p[name='remove-cat']", function () {

  console.log(this);

  let currentTr = this.closest("tr");


  let cat_id = $(currentTr).attr("cat-id");
  console.log(currentTr);

  if (window.confirm("Are you sure to remove sub category")) {
    if (
      window.confirm(
        "Are you still  want to remove sub category post your action cannot be rollback"
      )
    ) {
      console.log(cat_id);

      let data = {
        removeMainCategory:"removeMainCategory",
        cat_id:cat_id,
      };      

      console.log(data);

      $.post(
        "./phpAjax/categoryManagentAjax.php",
        data,
        function (data, textStatus, jqXHR) {
          console.log(data);
          if (data.success) {
            alert("Row success");
            addRowToMainCatTable();
          }
        },
        "json"
      ).fail((error) => {
        console.log(error);
      });
    }
  }
});
