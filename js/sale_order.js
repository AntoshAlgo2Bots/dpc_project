$("#saleOrderSavebtn").on("click", function () {
  console.log("clicked on save button");

  let inputs = document.querySelectorAll("input");

  let inputsData = {};

  inputs.forEach((input, index) => {
    let name = input.name;
    let value = input.value;

    inputsData[name] = value;
  });

  let data = {};

  let itemsArray = [];
  const itemssDataCreate = (item_type, tbody_id) => {
    let tbody = $(`#${tbody_id}`)[0];

    let trows = tbody.querySelectorAll("tr");

    trows.forEach((row) => {
      let itemssData = {};
      let qty = row.querySelector("input[name='qty']").value;

      itemssData["item_id"] = $(row).attr("item-id");
      itemssData["quantuty"] = qty;
      itemssData["item_type"] = item_type;

      itemssData["rate"] = row
        .querySelector("p[name='rate']")
        .getAttribute("itemprice");
      itemssData["itemname"] = row
        .querySelector("p[name='itemname']")
        .getAttribute("itemname");
      itemssData["itemcode"] = row
        .querySelector("p[name='itemcode']")
        .getAttribute("itemcode");
      itemssData["item_image"] = row.getAttribute("item-image");




      // console.log($("p[name='rate']"));

      itemsArray.push(itemssData);
    });
  };

  itemssDataCreate("finish_good", "finish_good_items_body");
  itemssDataCreate("row_item", "row_items_body");

  data["userInputData"] = inputsData;
  data["createdSaleOrder"] = "createdSaleOrder";
  data["inItems"] = itemsArray;

  console.log("data", data);
  $.post(
    "./saleOrderAjax.php",
    data,
    function (data) {
      if (data.success) {
        alert(`Sale order created success fully ${data.so_number}`);

        $("input[name='sales_order_number']").val(data.so_number);
        $("input[name='sales_order_number']").fadeIn(1000);



      }
      console.log(data);
    },
    "json"
  ).fail((error) => {



    console.log(error.responseText);
  });

  // console.log(inputsData);
});

const setBomItemInSearch = (bom_data) => {
  let tbody = $("#serchItemBox")[0];

  tbody.innerHTML = "";
  bom_data.forEach((Element, index) => {
    index++;
    let tr = document.createElement("tr");

    tr.innerHTML = `
    <tr class="hover:bg-slate-50">
    <td class="p-4">
    <p class="text-sm font-bold">
    ${index}
    </p>
                                                </td>

                                                <td class="p-4">
                                                <p class="text-sm">
                                                ${Element.product_code}
                                                </p>
                                                </td>

                                                <td class="p-4">
                                                <p class="text-sm">
                                                    ${Element.product_name}
                                               </p>

                                               </td>


                                                    <td class="p-4">
                                                    <p class="text-sm">
                                                    ${Element.product_rate}
                                                    </p>
                                                    </td>

                                                    <td class="p-4">
                                                    <p class="text-sm">
                                                    ${Element.product_qty}
                                                    </p>
                                                    </td>

                                                    <td class="p-4">
                                                    <p class="text-sm">
                                                    ${Element.total_price}
                                                    </p>
                                                    </td>
                                                    
                                                                                                      
                                                    <td class="p-4">
                                                    <a  head-id='${Element.s_no}' onclick='setIdToBomTable(event)'  class="text-sm cursor-pointer font-semibold ">
                                                    Add
                                                    </a>
                                                    </td>

                                                       <td class="p-4 border-b border-slate-200 py-5">
                                                <img src="./images/${Element.product_img}" alt="Product 1" class="w-16 h-16 object-cover rounded" />
                                            </td>
                                                    </tr>
                                                    
                                                    
                                                    
                                                    `;

    $(tbody).append(tr);
  });
};

$("#  ").on("input", function () {
  let searchQuery = 1;

  setItemsForAddInItems(searchQuery);
});


const setItemsForAddInItems = (searchQuery) => {
  let data = {
    getIBomItem: "getIBomItem",
    searchQuery: searchQuery,
  };

  $.get(
    "./saleOrderAjax.php",
    data,
    function (data) {
      console.log(data);

      if (data.success) {
        let bom_data = data.bom_data;

        setBomItemInSearch(bom_data);
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
};


const setIdToBomTable = (event) => {
  let id = $(event.target).attr("head-id");

  setBomDataToTable(id);

  let tr = event.target.closest("tr");

  $(event.target).fadeOut();
};

const setBomDataToTable = (id) => {
  let tbody = $("#finish_good_items_body")[0];
  $(tbody.closest("table")).fadeIn(1000);

  let data = {
    getIBomItemOnlyData: "getIBomItemOnlyData",
    search_id: id,
  };

  $.get(
    "./saleOrderAjax.php",
    data,
    function (data) {
      // console.log(data);

      if (data.success) {
        let bom_data = data.bom_data[0];

        let length = tbody.querySelectorAll("tr").length;
        length++;

        console.log(bom_data);

        console.log(bom_data.product_name);

        let tr = document.createElement("tr");
        tr.setAttribute("item-id",bom_data.s_no);
        tr.setAttribute("item-type", "finish_good");
        tr.setAttribute("item-name", bom_data.product_name);
        tr.innerHTML = `

                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="block font-semibold text-sm text-slate-800">${length}</p>
                                            </td>

                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p name='itemname' itemname='${bom_data.product_name}' class="text-sm text-slate-500">${bom_data.product_name}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p name='itemcode' itemcode='${bom_data.product_code}' class="text-sm text-slate-500">${bom_data.product_code}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">

                                                <p name='rate' itemPrice='${bom_data.product_rate}' class="text-sm text-slate-500">${bom_data.product_rate}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <input type="number" name="qty"
                                                    class="w-28 rounded-md border text-xs border-gray-500 bg-white py-2 text-[#6B7280] h-6 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                                    style="border-color: #C8A1E0;" />
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">

                                                <p class="text-sm text-slate-500"><input type="number" name="total_price"
                                                    class="w-28 rounded-md border text-xs border-gray-500 bg-white py-2 text-[#6B7280] h-6 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                                    style="border-color: #C8A1E0;" /></p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <img src="./images/${bom_data.product_img}" alt="Product 1" class="w-16 h-16 object-cover rounded" />
                                            </td>



                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <button onclick='selfRemoveRowFromTable(event)' type="button" class="text-slate-500 hover:text-slate-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </td>

                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <button name='openBomBodyBox'
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                    type="button">
                                                    Bom
                                                </button>
                                            </td>                                                    
              `;

        $(tbody).append(tr);

        // let dataForline = {
        //   getDataOfLineBom: "getDataOfLineBom",
        //   bomId: id,
        // };
        // $.getJSON(
        //   "./saleOrderAjax.php",
        //   dataForline,
        //   function (data) {
        //     console.log(data);

        //     if(data.success){

        //       let attrData = data.tbody_data

        //       let bomLineData = {
        //         bomid:{

        //         },

        //       }

        //     }

        //   }
        // ).fail((error) => {
        //   console.log(error.responseText);
        // });
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
};

$("#finish_good_items_body").on(
  "click",
  "button[name='openBomBodyBox']",
  function () {
    $("#openBomBodyBox").click();

    let currentTr = $(this)[0].closest("tr");
    let bom_id = $(currentTr).attr("item-id");

    console.log(bom_id);

    let data = {
      getBomDataById: "getBomDataById",
      bom_id: bom_id,
    };

    $.getJSON(
      "./saleOrderAjax.php",
      data,
      function (data, textStatus, jqXHR) {
        console.log(data);

        if (data.success) {
          let resData = data.data;

          $("input[name='bom_item_name']").val(resData[0].item_name);
          $("input[name='wharehouse_location']").val(resData[0].wharehouse_);

          $("#bomLineTbody").html("");
          resData.forEach((row, index) => {
            index++;

            $("#bomLineTbody").append(`
              
                <tr class="hover:bg-slate-50">
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <img src="https://demos.creative-tim.com/corporate-ui-dashboard-pro/assets/img/kam-idris-_HqHX3LBN18-unsplash.jpg" alt="Product 1" class="w-16 h-16 object-cover rounded" />
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="block font-semibold text-sm text-slate-800">${index}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="text-sm text-slate-500">Process seq</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="text-sm text-slate-500">${row.line_item_code}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="text-sm text-slate-500">${row.item_name}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                ${row.quantity}
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                ${row.quantity}
                                            </td>
                                        </tr>

              
              `);
          });

          let orderObject = [
            {
              bom_id: 47,
              lineid: 1,
              itemCode: item_code,
              attrs: {
                color: black,
              },
            },
          ];
        }
      }
    ).fail((error) => {
      console.log(error);
    });
  }
);

const selfRemoveRowFromTable = (event) => {
  let tr = event.target.closest("tr");

  $(tr).remove();
  1000;
};

//this is for row items

const setItemsForAddInItemsRow = (searchQuery) => {
  let data = {
    getRowItem: "getRowItem",
    searchQuery: searchQuery,
  };

  $.get(
    "./saleOrderAjax.php",
    data,
    function (data) {
      console.log(data);

      if (data.success) {
        let item_master_data = data.bom_data;

        console.log(item_master_data);

        let tbody = $("#serchItemBoxRow")[0];

        tbody.innerHTML = "";
        item_master_data.forEach((Element, index) => {
          index++;
          let tr = document.createElement("tr");

          tr.innerHTML = `
                  <tr class="hover:bg-slate-50">
                  <td class="p-4">
                  <p class="text-sm font-bold">
                  ${index}
                  </p>
                                                              </td>
                                                              <td class="p-4">
                                                              <p class="text-sm">
                                                              ${Element.item_code}
                                                              </p>
                                                              </td>
                                                              <td class="p-4">
                                                              <p class="text-sm">
                                                                  ${Element.Short_Description}
                                                             </p>
                                                             </td>
                                                                  <td class="p-4">
                                                                  <p class="text-sm">
                                                                  ${Element.Price}
                                                                  </p>
                                                                  </td>
                                                                                                                    
                                                                  <td class="p-4">
                                                                  <a  head-id='${Element.S_No}' onclick='setIdToBomTableRow(event)'  class="text-sm cursor-pointer font-semibold ">
                                                                  Add
                                                                  </a>
                                                                  </td>
                   <td class="p-4 border-b border-slate-200 py-5">
                                                <img src="./images/${Element.imagePath}" alt="Product 1" class="w-16 h-16 object-cover rounded" />
                                            </td>


                                                                  </tr>
                                                                  
                                                                  
                                                                  
                                                                  `;

          $(tbody).append(tr);
        });
      }
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
};

$("#search_input_item_row").on("input", function () {
  let searchQuery = $("#search_input_item_row").val();

  setItemsForAddInItemsRow(searchQuery);
});

const setBomDataToTableRow = (id) => {
  let tbody = $("#row_items_body")[0];

  $(tbody.closest("table")).fadeIn(1000);

  let data = {
    getIBomItemOnlyDataRow: "getIBomItemOnlyDataRow",
    search_id: id,
  };

  $.get(
    "./saleOrderAjax.php",
    data,
    function (data) {
      // console.log(data);

      if (data.success) {
        let bom_data = data.bom_data[0];

        let length = tbody.querySelectorAll("tr").length;
        length++;

        console.log(bom_data);

        console.log(bom_data.item_code);

        let tr = document.createElement("tr");
        tr.setAttribute("item-id", bom_data.S_No);
        tr.setAttribute("item-image", bom_data.imagePath);

        tr.innerHTML = `

               

                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p class="block font-semibold text-sm text-slate-800">${length}</p>
                                            </td>

                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p name='itemname' itemname='${bom_data.Short_Description}'  class="text-sm text-slate-500">${bom_data.Short_Description}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <p name='itemcode' itemcode='${bom_data.item_code}' class="text-sm text-slate-500">${bom_data.item_code}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">

                                                <p name='rate' itemPrice='${bom_data.Price}' class="text-sm text-slate-500">${bom_data.Price}</p>
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <input type="number" name="qty"
                                                    class="w-28 rounded-md border text-xs border-gray-500 bg-white py-2 text-[#6B7280] h-6 outline-none focus:border-[#6A64F1] focus:shadow-md"
                                                    style="border-color: #C8A1E0;" />
                                            </td>
                                            <td class="p-4 border-b border-slate-200 py-5">

                                                <p name='total_price' class="text-sm text-slate-500">200</p>
                                            </td>
                                            <td  class="p-4 border-b border-slate-200 py-5">
                                                <img src="./images/${bom_data.imagePath}" alt="Product 1" class="w-16 h-16 object-cover rounded" />
                                            </td>



                                            <td class="p-4 border-b border-slate-200 py-5">
                                                <button onclick='selfRemoveRowFromTable(event)' type="button" class="text-slate-500 hover:text-slate-700">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </td>




              
              `;

        $(tbody).append(tr);
      }

      ////setting up with json
    },
    "json"
  ).fail((error) => {
    console.log(error);
  });
};

const setIdToBomTableRow = (event) => {
  let id = $(event.target).attr("head-id");

  setBomDataToTableRow(id);

  let tr = event.target.closest("tr");

  $(event.target).fadeOut();
};


