

// filename: [script.js]
// author: [Abdullahi Hussein Dahir]
// description: [files it works on: OrderStatistic.php]

document.addEventListener('DOMContentLoaded', function () {
    // Ensure the SVG container has the correct ID
    const svgContainer = d3.select('#bar-chart');

    // Set dimensions and margins for the graph
    var margin = { top: 20, right: 20, bottom: 60, left: 140 };
    var width = 640 - margin.left - margin.right;
    var height = 520 - margin.top - margin.bottom;

    // Append SVG object to the chart div
    const svg = svgContainer
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // Parse the Data
    customerData.forEach(function (d) {
        d.Frequency = +d.Frequency; // Convert frequency to number
    });

    // Add X axis
    const x = d3.scaleLinear()
        .domain([0, d3.max(customerData, d => d.Frequency)])
        .range([0, width]);

    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(d3.axisBottom(x)
            .ticks(3)
            .tickFormat(d3.format('d'))
        )
        .selectAll("text")
        // .attr("transform", "translate(-10,0)rotate(-45)")
        .style("text-anchor", "end")
        .style("fill", "black");

    // Y axis
    const y = d3.scaleBand()
        .range([0, height])
        .domain(customerData.map(d => d.MenuName))
        .padding(0.1);

    svg.append("g")
        .call(d3.axisLeft(y))
        .selectAll("text")
        .style("fill", "black"); // Set the tick labels to black

    // Bars
    svg.selectAll("myBar")
        .data(customerData)
        .join("rect")
        .attr("x", x(0))
        .attr("y", d => y(d.MenuName))
        .attr("width", d => x(d.Frequency))
        .attr("height", y.bandwidth())
        .attr("fill", "grey");

    // Add tooltip
    const tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    // Add interactivity (tooltip)
    svg.selectAll("rect")
        .on("mouseover", function (event, d) {
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html(`Menu: ${d.MenuName}<br/>Frequency: ${d.Frequency}`)
                .style("left", (event.pageX + 5) + "px")
                .style("top", (event.pageY - 28) + "px");
        })
        .on("mouseout", function () {
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        });

    // Add the X Axis label
        svg.append("text")
            .attr("text-anchor", "end")
            .attr("x", width / 2 + margin.left - 140)
            .attr("y", height + margin.top + 20)
            .text("Frequency")
            .attr("font-weight", "bold");

        // Add the Y Axis label
        svg.append("text")
            .attr("text-anchor", "end")
            .attr("transform", "rotate(-90)")
            .attr("y", -margin.left + 20)
            .attr("x", -height / 2 + 20)
            .text("Menu Name")
            .attr("font-weight", "bold");
});
