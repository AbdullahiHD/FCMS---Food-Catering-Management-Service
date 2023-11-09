// document.addEventListener('DOMContentLoaded', function () {
//     // Ensure the SVG container has the correct ID
//     const svgContainer = d3.select('#bar-chart');

//     // Set dimensions and margins for the graph
//     var margin = { top: 20, right: 10, bottom: 50, left: 20 };
//     var width = 560 - margin.left - margin.right;
//     var height = 500 - margin.top - margin.bottom;

//     // Append SVG object to the chart div
//     const svg = svgContainer
//         .attr("width", width + margin.left + margin.right)
//         .attr("height", height + margin.top + margin.bottom)
//         .append("g")
//         .attr("transform", `translate(${margin.left},${margin.top})`);

//     // X axis
//     const x = d3.scaleBand()
//         .range([0, width])
//         .domain(customerData.map(d => d.City))
//         .padding(0.1); document.addEventListener('DOMContentLoaded', function () {
//             // Ensure the SVG container has the correct ID
//             const svgContainer = d3.select('#bar-chart');

//             // Set dimensions and margins for the graph
//             var margin = { top: 20, right: 10, bottom: 50, left: 20 };
//             var width = 560 - margin.left - margin.right;
//             var height = 500 - margin.top - margin.bottom;

//             // Append SVG object to the chart div
//             const svg = svgContainer
//                 .attr("width", width + margin.left + margin.right)
//                 .attr("height", height + margin.top + margin.bottom)
//                 .append("g")
//                 .attr("transform", `translate(${margin.left},${margin.top})`);

//             // X axis
//             const x = d3.scaleBand()
//                 .range([0, width])
//                 .domain(customerData.map(d => d.City))
//                 .padding(0.1);

//             const xAxisGroup = svg.append("g")
//                 .attr("transform", `translate(0, ${height})`)
//                 .call(d3.axisBottom(x));

//             // Style the X axis lines and ticks
//             xAxisGroup.select(".domain").attr("stroke", "black").attr("stroke-width", "1");
//             xAxisGroup.selectAll("line").attr("stroke", "black").attr("stroke-width", "1");

//             // Style the X axis labels
//             xAxisGroup.selectAll("text")
//                 .attr("transform", "translate(-10,0)rotate(-45)")
//                 .style("text-anchor", "end")
//                 .attr("fill", "black") // Set the color of the text
//                 .attr("font-weight", "bold"); // Make the text bold

//             // Add Y axis
//             const y = d3.scaleLinear()
//                 .domain([0, d3.max(customerData, d => +d.NumberOfCustomers)])
//                 .range([height, 0]);

//             const yAxisGroup = svg.append("g")
//                 .call(d3.axisLeft(y));

//             // Style the Y axis lines and ticks
//             yAxisGroup.select(".domain").attr("stroke", "black").attr("stroke-width", "1");
//             yAxisGroup.selectAll("line").attr("stroke", "black").attr("stroke-width", "1");

//             // Style the Y axis labels
//             yAxisGroup.selectAll("text")
//                 .attr("fill", "black") // Set the color of the text
//                 .attr("font-weight", "bold"); // Make the text bold

//             // Bars
//             svg.selectAll("mybar")
//                 .data(customerData)
//                 .join("rect")
//                 .attr("x", d => x(d.City))
//                 .attr("y", d => y(d.NumberOfCustomers))
//                 .attr("width", x.bandwidth())
//                 .attr("height", d => height - y(d.NumberOfCustomers))
//                 .attr("fill", "#69b3a2");

//             // Tooltip (assuming you have the correct CSS for .tooltip)
//             const tooltip = d3.select("body").append("div")
//                 .attr("class", "tooltip")
//                 .style("opacity", 0);

//             // Add interactivity (tooltip)
//             svg.selectAll("rect")
//                 .on("mouseover", function (event, d) {
//                     tooltip.transition()
//                         .duration(200)
//                         .style("opacity", .9);
//                     tooltip.html("City: " + d.City + "<br/>" + "Customers: " + d.NumberOfCustomers)
//                         .style("left", (event.pageX) + "px")
//                         .style("top", (event.pageY - 28) + "px");
//                 })
//                 .on("mouseout", function (d) {
//                     tooltip.transition()
//                         .duration(500)
//                         .style("opacity", 0);
//                 });
//         });


//     const xAxisGroup = svg.append("g")
//         .attr("transform", `translate(0, ${height})`)
//         .call(d3.axisBottom(x));

//     // Style the X axis lines and ticks
//     xAxisGroup.select(".domain").attr("stroke", "black").attr("stroke-width", "1");
//     xAxisGroup.selectAll("line").attr("stroke", "black").attr("stroke-width", "1");

//     // Style the X axis labels
//     xAxisGroup.selectAll("text")
//         .attr("transform", "translate(-10,0)rotate(-45)")
//         .style("text-anchor", "end")
//         .attr("fill", "black") // Set the color of the text
//         .attr("font-weight", "bold"); // Make the text bold

//     // Add Y axis
//     const y = d3.scaleLinear()
//         .domain([0, d3.max(customerData, d => +d.NumberOfCustomers)])
//         .range([height, 0]);

//     const yAxisGroup = svg.append("g")
//         .call(d3.axisLeft(y));

//     // Style the Y axis lines and ticks
//     yAxisGroup.select(".domain").attr("stroke", "black").attr("stroke-width", "1");
//     yAxisGroup.selectAll("line").attr("stroke", "black").attr("stroke-width", "1");

//     // Style the Y axis labels
//     yAxisGroup.selectAll("text")
//         .attr("fill", "black") // Set the color of the text
//         .attr("font-weight", "bold"); // Make the text bold

//     // Bars
//     svg.selectAll("mybar")
//         .data(customerData)
//         .join("rect")
//         .attr("x", d => x(d.City))
//         .attr("y", d => y(d.NumberOfCustomers))
//         .attr("width", x.bandwidth())
//         .attr("height", d => height - y(d.NumberOfCustomers))
//         .attr("fill", "#69b3a2");

//     svg.append("text")
//         .attr("text-anchor", "end")
//         .attr("x", width / 2 + margin.left)
//         .attr("y", height + margin.top + 40) // Adjust the position based on your margins
//         .text("City")
//         .attr("fill", "black")
//         .attr("font-weight", "bold");

//     // Add Y axis label:
//     svg.append("text")
//         .attr("text-anchor", "end")
//         .attr("transform", "rotate(-90)") // Rotate the text for Y-axis
//         .attr("y", -margin.left + 10) // Adjust the position based on your margins
//         .attr("x", -margin.top - height / 2 + 20)
//         .text("Number of Customers")
//         .attr("fill", "black")
//         .attr("font-weight", "bold");

//     // Tooltip (assuming you have the correct CSS for .tooltip)
//     const tooltip = d3.select("body").append("div")
//         .attr("class", "tooltip")
//         .style("opacity", 0);

//     // Add interactivity (tooltip)
//     svg.selectAll("rect")
//         .on("mouseover", function (event, d) {
//             tooltip.transition()
//                 .duration(200)
//                 .style("opacity", .9);
//             tooltip.html("City: " + d.City + "<br/>" + "Customers: " + d.NumberOfCustomers)
//                 .style("left", (event.pageX) + "px")
//                 .style("top", (event.pageY - 28) + "px");
//         })
//         .on("mouseout", function (d) {
//             tooltip.transition()
//                 .duration(500)
//                 .style("opacity", 0);
//         });
// });

document.addEventListener('DOMContentLoaded', function () {
    // Ensure the SVG container has the correct ID
    const svgContainer = d3.select('#bar-chart');

    // Set dimensions and margins for the graph
    var margin = { top: 20, right: 20, bottom: 50, left: 60 };
    var width = 560 - margin.left - margin.right;
    var height = 400 ; // Adjusted height to fit axis labels

    // Append SVG object to the chart div
    const svg = svgContainer
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + 20)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Set the ranges for the scales
    const x = d3.scaleLinear()
        .range([0, width])
        .domain([0, d3.max(employeeEfficiencyData, d => +d.rates)]);

    const y = d3.scaleLinear()
        .range([height, 0])
        .domain([0, d3.max(employeeEfficiencyData, d => +d.tasks_completed)]);

    // Add the X Axis
    const xAxisGroup = svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(d3.axisBottom(x))
        .attr("color", "black");

    // Add the Y Axis
    const yAxisGroup = svg.append("g")
        .call(d3.axisLeft(y))
        .attr("color", "black");

    // Add the scatterplot points
    svg.selectAll("dot")
        .data(employeeEfficiencyData)
        .enter().append("circle")
        .attr("r", 6) // Size of the dot
        .attr("cx", d => x(d.rates))
        .attr("cy", d => y(d.tasks_completed))
        .attr("fill", "#69b3a2");

    // Add X axis label:
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("x", width / 2 + margin.left + 25)
        .attr("y", height + margin.top + 25)
        .text("Hourly Rates (RM)")
        .attr("font-weight", "bold");

    // Add Y axis label:
    svg.append("text")
        .attr("text-anchor", "end")
        .attr("transform", "rotate(-90)")
        .attr("y", -margin.left + 20)
        .attr("x", -height / 2 + 70)
        .text("Tasks Completed")
        .style("font-size", "16px") // Adjust font size as needed
        .attr("font-weight", "bold");
    
    // Select the tooltip div and define its behavior
    var tooltip = d3.select("#tooltip");

    // Tooltip mouseover event handler
    var mouseover = function (event, d) {
        tooltip.transition()
            .duration(200)
            .style("opacity", .9);
        tooltip.html("Name: " + d.employeeName + "<br>Occupation: " + d.occupation)
            .style("left", (event.pageX) + "px")
            .style("top", (event.pageY - 28) + "px");
    }

    // Tooltip mousemove event handler
    var mousemove = function (event, d) {
        tooltip.style("left", (event.pageX) + "px")
            .style("top", (event.pageY - 28) + "px");
    }

    // Tooltip mouseleave event handler
    var mouseleave = function (event, d) {
        tooltip.transition()
            .duration(500)
            .style("opacity", 0);
    }

    // Add the scatterplot points with tooltip events
    svg.selectAll("dot")
        .data(employeeEfficiencyData)
        .enter().append("circle")
        .attr("r", 5) // Size of the dot
        .attr("cx", d => x(+d.rates))
        .attr("cy", d => y(+d.tasks_completed))
        .attr("fill", "#69b3a2")
        .on("mouseover", mouseover) // Bind mouseover event
        .on("mousemove", mousemove) // Bind mousemove event
        .on("mouseleave", mouseleave); // Bind mouseleave event

});

