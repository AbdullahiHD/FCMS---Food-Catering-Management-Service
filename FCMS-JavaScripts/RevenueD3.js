// filename: [script.js]
// author: [Abdullahi Hussein Dahir]
// description: [files it works on: RevenueStatistic.php]

document.addEventListener('DOMContentLoaded', function () {
    const svgContainer = d3.select('#bar-chart');

    var margin = { top: 20, right: 20, bottom: 60, left: 80 };
    var width = 640 - margin.left - margin.right;
    var height = 500 - margin.top - margin.bottom;

    const svg = svgContainer
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Parse the Date and Sales
    var parseDate = d3.timeParse("%Y-%m-%d");
    salesData.forEach(function (d) {
        d.SalesDate = parseDate(d.SalesDate);
        d.TotalSales = +d.TotalSales;
    });

    // Set the ranges
    const x = d3.scaleTime().range([0, width]);
    const y = d3.scaleLinear().range([height, 0]);

    // Define the line
    var valueline = d3.line()
        .x(function (d) { return x(d.SalesDate); })
        .y(function (d) { return y(d.TotalSales); });

    // Scale the range of the data
    x.domain(d3.extent(salesData, function (d) { return d.SalesDate; }));
    y.domain([0, d3.max(salesData, function (d) { return d.TotalSales; })]);

    // Adding the valueline path
    svg.append("path")
        .data([salesData])
        .attr("class", "line")
        .attr("d", valueline);

    // Adding the X Axis
    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(d3.axisBottom(x))
        .attr("color", "black"); // Set the color of the axis line and ticks to black

    // Adding the Y Axis
    svg.append("g")
        .call(d3.axisLeft(y))
        .attr("color", "black"); // Set the color of the axis line and ticks to black


    // Adding the X Axis label
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("x", width / 2)
        .attr("y", height + margin.bottom - 10)
        .text("Date")
        .attr("font-weight", "bold");

    // Adding the Y Axis label
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("transform", "rotate(-90)")
        .attr("y", -margin.left + 20)
        .attr("x", -height / 2 + 20)
        .text("Total Sales (RM)")
        .attr("font-weight", "bold");


    // Define the div for the tooltip
    var tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    // Append the circles for each data point
    svg.selectAll(".point")
        .data(salesData)
        .enter().append("circle")
        .attr("class", "point")
        .attr("cx", function (d) { return x(d.SalesDate); })
        .attr("cy", function (d) { return y(d.TotalSales); })
        .attr("r", 5) // Radius of the point
        .style("cursor", "pointer") // Cursor pointer on hover
        .on("mouseover", function (event, d) {
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html(`Date: ${d3.timeFormat("%Y-%m-%d")(d.SalesDate)}<br/>Total Sales: ${d.TotalSales}`)
                .style("left", (event.pageX) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function (d) {
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });

});
