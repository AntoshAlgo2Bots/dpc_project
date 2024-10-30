const setRequireFieldsFromCategory = (event) => {
  // document.getElementById("attrArea").innerText = "";
  // document.getElementById("attrArea").style.display="flex";

  let id = $(event.target).attr("cat-id");
  let cat_name = $(event.target).attr("cat-name");

  $("#sub-cat-attr-area").html("");

  $("#item_category").val(cat_name);

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
        $("#sub-cat-area-field").html("");

        console.log(data);

        console.log(Object.keys(resData));

        Object.keys(resData).forEach((element) => {
          console.log(resData[element][0].SubcatId);
          $("#sub-cat-area-field").append(
            ` <h3 class="font-bold text-lg underline">${element} <button  sub-name='${element}' sub-id='${resData[element][0].SubcatId}' class="text-2xl focus:outline-none"
                                onclick="getRequiredAttreForSubCat(event)">+</button>
                        </h3>`
          );
        });
      }

      // addSubCatFields(resData)
    },
    error: function (error) {
      console.log(error);
    },
  });
};

const getRequiredAttreForSubCat = (event) => {
  // document.getElementById("attrArea").innerText = "";
  // document.getElementById("attrArea").style.display="flex";
  $("#sub-cat-attr-area").html("");

  let subCatId = $(event.target).attr("sub-id");
  let sub_cat_name = $(event.target).attr("sub-name");

  $("#item_sub_category").val(sub_cat_name);
  $("#item_sub_category").attr("sub-id", subCatId);

  data = {
    getSubCatAttrs: "getSubCatAttrs",
    subCatId: subCatId,
  };

  $.ajax({
    url: "./phpAjax/itemMasterCreationAjax.php",
    method: "GET",
    data,
    dataType: "json",
    success: function (data) {
      // document.getElementById("sub_catArea").innerText = ""
      let resData = data.data;

      if (data.success) {
        console.log(resData);

        $("#sub-cat-attr-area").html("");

        resData.forEach((element) => {
          if (element.dropdown == "no") {
            console.log("hell");

            $("#sub-cat-attr-area").append(`
                   <div>
                            <label
                                class="block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">${element.name} :
                            </label>
                            <input type="text" name="${element.name}" 
                                class="w-44 rounded-md border text-xs border-gray-500 bg-white py-1 pl-2 text-[#6B7280] h-6 outline-none mb-3 focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                `);
          }

          if (element.dropdown == "yes") {
            let select = document.createElement("select");
            select.name = element.name;
            select.classList.add(
              "w-44",
              "rounded-md",
              "border",
              "text-xs",
              "border-gray-500",
              "bg-white",
              "py-1",
              "pl-2",
              "text-[#6B7280]",
              "h-6",
              "outline-none",
              "mb-3",
              "focus:border-[#6A64F1]",
              "focus:shadow-md"
            );

            select.innerHTML = `

               <option selected hidden  disabled  >Select</option>
            `;

            $.ajax({
              url: "ajaxItemMaster.php",
              method: "GET",
              dataType: "json",
              data: {
                getOptionAttr: "getOptionAttr",
                attr_id: element.attr_id,
              },
              success: function (data) {
                // console.log(data.data);

                data.data.forEach((element) => {
                  var option = document.createElement("option");

                  function capitalizeFirstLetter(string) {
                    return string.charAt(0).toUpperCase() + string.slice(1);
                  }

                  // option.innerText = element.description;
                  option.innerText = element.description;
                  option.value = element.description;

                  // console.log(element.description);

                  select.appendChild(option);
                });
              },
              error: function (error) {
                console.log(error);
              },
            });

            let div = document.createElement("div");

            div.innerHTML = `
             <label
                    
                
                
                class="block mb-2 font-bold text-xs font-medium text-gray-900 dark:text-white">${element.name} :
                            </label>
            
            
        
            
                            `;

            $(div).append(select);
            $("#sub-cat-attr-area").append(div);
          }
        });
      }

      // addSubCatFields(resData)
    },
    error: function (error) {
      console.log(error.responseText);
    },
  });
  genRateItemCOde()
};

const saveItemDataToTemp = () => {
  let attrData = {};
  let itemCodeGen = "";
  let shortDescription = $("#item_sub_category").val();

  itemCodeGen += $("#item_category").val().substring(0, 2);

  let sub_id = $("#item_sub_category").attr("sub-id");

  attrData["manCatId"] = $("#item_category").val();
  attrData["SubCatid"] = sub_id;

  let inputs = document.querySelectorAll("input");

  inputs.forEach((input, index) => {
    let attributeValue = input.value;
    attrData[input.name] = input.value;
    if ((index > 0) & (index < 10)) {
      itemCodeGen += "-";
      itemCodeGen += attributeValue.substring(0, 2);
    }

    if ((index > 0) & (index < 6)) {
      let attributeValue = input.value;
      shortDescription += "-";
      shortDescription += attributeValue.substring(0, 4);
      console.log(attributeValue);
    }

    console.log(`  name is  ${attributeValue} `);
  });
  let selects = document.querySelectorAll("select");

  selects.forEach((select) => {
    attrData[select.name] = select.value;
  });

  let data = {
    saveItemDataToTemp: "saveItemDataToTemp",
    attrData: attrData,
  };

  console.log(data);

  attrData["itemCodeGenrated"] = itemCodeGen;
  attrData["item_description"] = item_description;
  attrData["finish_type"] = $("#finish_raw_material").val();

  let itemFilePath = "";

  let fileItem = document.querySelector('[name="itemImage"]');

  if (fileItem && fileItem.files.length > 0) {
    var formData = new FormData();
    formData.append("itemImage", fileItem.files[0]);

    // Assuming there are other fields in the form to append to formData

    $.ajax({
      url: "./phpAjax/itemMasterCreationAjax.php",
      type: "POST",
      data: formData,
      dataType: "JSON",
      contentType: false, // Prevent jQuery from setting Content-Type header
      processData: false, // Prevent jQuery from converting the data into a query string
      success: function (response) {
        if (response.success) {
          alert("Image uploaded successfully");

          itemFilePath = response.filePath;

          console.log("File path is :" + response.filePath);
          console.log(response);

          document.getElementById("uploaded_file_path").style.display = "block";
          document.getElementById(
            "uploaded_file_path"
          ).src = `./images/${itemFilePath}`;

          data["filePath"] = itemFilePath;

          $.post(
            "./phpAjax/itemMasterCreationAjax.php",
            data,
            function (data, textStatus, jqXHR) {
              console.log(data);

              if (data.success) {
                $("#item_code").val(data.item_code);
                $("#record_id").val(data.recordId);
                $("#item_name").val(data.item_description);

                alert("Request created success fully");

                $("#save-item").fadeOut(1000);
              }
            },
            "json"
          ).fail((error) => {
            console.log(error);
          });
        }
      },
      error: function (error) {
        console.error(error);
      },
    });
  } else {
    alert("Please uplaod the picture and fill the valid fields");
    console.log("No file selected or file input not found.");
  }
};



const genRateItemCOde = () => {


  let itemcode = ""


  let inputs = document.querySelectorAll("input");


  inputs.forEach(input => {

    itemcode += input.value.substring(0, 2)
    itemcode += "-";







  })



  console.log(itemcode)

  $("#item_code").val(itemcode)






}

console.log("fjeoi")