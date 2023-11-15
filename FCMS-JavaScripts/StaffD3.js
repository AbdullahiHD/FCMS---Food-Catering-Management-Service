

document.addEventListener('DOMContentLoaded', function () {
    const svgContainer = d3.select('#bar-chart');

    // Set dimensions and margins for the graph
    var margin = { top: 20, right: 20, bottom: 50, left: 60 };
    var width = 640 - margin.left - margin.right;
    var height = 440 ; // Adjusted height to fit axis labels

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

