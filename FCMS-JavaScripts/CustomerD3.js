// /*
// filename: [CustomerD3.js]
// author: [Abdullahi Hussein Dahir]
// description: [html files it works on : CustomerStatistics.php]
// */

// Ensure the SVG container has the correct ID
document.addEventListener('DOMContentLoaded', function () {
    // Ensure the SVG container has the correct ID
    const svgContainer = d3.select('#bar-chart');

    // Set dimensions and margins for the graph
    var margin = { top: 20, right: 20, bottom: 60, left: 60 };
    var width = 640 - margin.left - margin.right;
    var height = 450 - margin.top - margin.bottom;

    // Append SVG object to the chart div
    const svg = svgContainer
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Parse the Data
    customerOrderData.forEach(function (d) {
        d.NumberOfOrders = +d.NumberOfOrders; // Convert NumberOfOrders to a number if it's not already
    });

    // X axis - Customer names
    const x = d3.scaleBand()
        .range([0, width])
        .domain(customerOrderData.map(d => d.FirstName + " " + d.LastName)) // Combine first and last names
        .padding(0.1);
    
    const xAxisGroup = svg.append("g")
        .attr("transform", `translate(0,${height})`)
        .call(d3.axisBottom(x));

    // const xAxisGroup = svg.append("g")
    //     .attr("transform", `translate(0, ${height})`)
    //     .call(d3.axisBottom(x))
    //     .selectAll("text")
    //     .attr("transform", "translate(-10,0)rotate(-45)")
    //     .style("text-anchor", "end")
    //     .attr("fill", "black") // Set the color of the text to black
    //     .attr("font-weight", "bold");

    xAxisGroup.selectAll("text")
        .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end")
        .attr("fill", "black") // Set the color of the text to black
        .attr("font-weight", "bold");

    // Y axis - Number of Orders
    const y = d3.scaleLinear()
        .domain([0, d3.max(customerOrderData, d => d.NumberOfOrders)])
        .range([height, 0]);

    const yAxisGroup = svg.append("g")
        .attr("class", "y-axis")
        .call(d3.axisLeft(y).tickFormat(d3.format('d'))) // Use integer format for ticks
        .attr("color", "black"); // Set the color of the ticks to black

    // Bars
    svg.selectAll("myBar")
        .data(customerOrderData)
        .join("rect")
        .attr("x", d => x(d.FirstName + " " + d.LastName))
        .attr("y", d => y(d.NumberOfOrders))
        .attr("width", x.bandwidth())
        .attr("height", d => height - y(d.NumberOfOrders))
        .attr("fill", "grey");

    // X axis label
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("x", width / 2 + margin.left)
        .attr("y", height + margin.top + 75) // Adjust for the rotated text
        .text("Customer Name")
        .attr("fill", "black")
        .attr("font-weight", "bold");

    // Y axis label
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("transform", "rotate(-90)")
        .attr("y", -margin.left + 20)
        .attr("x", -height / 2 + 60)
        .text("Number of Orders")
        .attr("fill", "black")
        .attr("font-weight", "bold");

    // Tooltip (assuming you have the correct CSS for .tooltip)
    const tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    // Add interactivity (tooltip)
    svg.selectAll("rect")
        .on("mouseover", function (event, d) {
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html(d.FirstName + " " + d.LastName + "<br/>" + "Orders: " + d.NumberOfOrders)
                .style("left", (event.pageX) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function () {
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });
    
    // Sort-Ascending Function
    function sortBarsAscending() {
        // Sort the data in ascending order
        customerOrderData.sort((a, b) => a.NumberOfOrders - b.NumberOfOrders);

        // Update the x-scale domain to the sorted order of names
        x.domain(customerOrderData.map(d => d.FirstName + " " + d.LastName));

        // Select and transition the bars to their new positions
        svg.selectAll("rect")
            .data(customerOrderData, d => d.FirstName + " " + d.LastName)
            .transition()
            .duration(1000)
            .attr("x", d => x(d.FirstName + " " + d.LastName))
            .attr("y", d => y(d.NumberOfOrders))
            .attr("height", d => height - y(d.NumberOfOrders));
        
        // Update and transition the x-axis
        xAxisGroup.transition()
            .duration(1000)
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "translate(-10,0)rotate(-45)")
            .style("text-anchor", "end");
    }

    // Sort-Descending Function
    function sortBarsDescending() {
        // Sort the data in descending order
        customerOrderData.sort((a, b) => b.NumberOfOrders - a.NumberOfOrders);

        // Update the x-scale domain to the sorted order of names
        x.domain(customerOrderData.map(d => d.FirstName + " " + d.LastName));

        // Select and transition the bars to their new positions
        svg.selectAll("rect")
            .data(customerOrderData, d => d.FirstName + " " + d.LastName)
            .transition()
            .duration(1000)
            .attr("x", d => x(d.FirstName + " " + d.LastName))
            .attr("y", d => y(d.NumberOfOrders))
            .attr("height", d => height - y(d.NumberOfOrders));
        
        // Update and transition the x-axis
        xAxisGroup.transition()
            .duration(1000)
            .call(d3.axisBottom(x))
            .selectAll("text")
            .attr("transform", "translate(-10,0)rotate(-45)")
            .style("text-anchor", "end");
    }



    // Event listeners for the sorting buttons
    d3.select(".sortAsc-button").on("click", sortBarsAscending);
    d3.select(".sortDesc-button").on("click", sortBarsDescending);

});