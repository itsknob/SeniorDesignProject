class ItemJS{
	ItemJS(n, c, p, d){
		name = n;
		cost = c;
		picture = p;
		desciption = d;
	}
}

function createTableFormattedItem(myItem){
	
	//Create Table
	var innerTable = document.createElement('table');
	//Set Border for Visibility
	innerTable.setAttribute('border', '2');

	//Create Table Rows
	var innerTableHeader = document.createElement('tr');
	var innerTablePicture = document.createElement('tr');
	var innerTableFooter = document.createElement('tr');

	//Create Table Data to append to Rows
	var nameData = document.createElement('td');
	var costData = document.createElement('td');
	var pictData = document.createElement('td');
	var descData = document.createElement('td');

	//Append Text to Table Data
	nameData.appendChild(document.createTextNode(myItem.name));
	costData.appendChild(document.createTextNode(myItem.cost));
	pictData.appendChild(document.createTextNode(myItem.picture));
	descData.appendChild(document.createTextNode(myItem.description));

	//Set Colspans on Elements for formatting
		//First Two will be on same row
	nameData.setAttribute('colspan', '1');
	costData.setAttribute('colspan', '1');
		//Following two each have their own row
	pictData.setAttribute('colspan', '2');
	descData.setAttribute('colspan', '2');

	//Append TD to TR
	innerTableHeader.appendChild(nameData);
	innerTableHeader.appendChild(costData);
	innerTablePicture.appendChild(pictData);
	innerTableFooter.appendChild(descData);

	//Append TR to Table
	innerTable.appendChild(innerTableHeader);
	innerTable.appendChild(innerTablePicture);
	innerTable.appendChild(innerTableFooter);

	return innerTable;	//A completed Table.

}

function createTableFormattedListOfItems(myItemArray){

	//Decide formatting for outerTable
	var numberOfColumns = 2;

	//Create Rows for Table (We will be formatting this into two rows for testing using 3 items.)	IE: 7 items, 3 columns -> 7/3 = ceil(2.33) = 3 rows
	var numberOfRows = Math.ceil((myItemArray.length)/numberOfColumns);
	//Keep track of where we are in the list.
	var currentItem = 0;

	//Create outer table
	var outerTable = document.createElement('table');
	//For Visibility
	outerTable.setAttribute('border', '2');
	
	//For each Row
	for(var i = 0; i < numberOfRows; i++){
		//Create TR
		var tempRow = document.createElement('tr');

		//Create table data elements for each column that will exist
		for(var j = 0; j < numberOfColumns; j++){
			//Create TD
			var tempCol = document.createElement('td');
			//Append Data
			tempCol.appendChild(createTableFormattedItem(myItemArray[currentItem]));	//Test this with createFormattedItem();
			//Next Item in Array
			currentItem++;
			//Append Column to Row
			tempRow.appendChild(tempCol);

			if(currentItem == myItemArray.length) break;
		}
		//Append Row to outerTable
		outerTable.appendChild(tempRow);

		if(currentItem == myItemArray.length) break;
	}
	return outerTable;
}
/*
// Add the contents of options[0] to #foo:
//document.getElementById('foo').appendChild(createTableFormattedListOfItems(itemArray));
*/
