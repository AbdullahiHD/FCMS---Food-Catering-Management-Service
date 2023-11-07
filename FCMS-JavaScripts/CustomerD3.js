
// /*
// filename: [script.js]
// author: [Abdullahi Hussein Dahir]
// created: [7th September 2023]
// last modified: [24th October 2023]
// description: [html files it works on : Index.html]
// */

// Assuming customerData is available and loaded properly from your PHP script
// console.log(customerData); // Make sure this prints your data

// document.addEventListener('DOMContentLoaded', function () {
//     console.log(d3); // This should print the D3 object to confirm it's loaded

//     // Append an SVG element to the div with the id 'chart'
//     const svg = d3.select('#bar-chart')
//         .append('svg')
//         .attr('width', 600)
//         .attr('height', 400)
//         .style('background-color', 'lightblue'); // Ensure the background color is set

//     // Append a text element to the SVG; this is just for testing
//     svg.append('text')
//         .attr('x', 200)
//         .attr('y', 200)
//         .text('D3 is working!')
//         .attr('font-size', '20px')
//         .attr('fill', 'black');

//     // Your code for visualizing customerData goes here
// });

document.addEventListener('DOMContentLoaded', function () {
    // Ensure the SVG container has the correct ID
    const svgContainer = d3.select('#bar-chart');

    // Set dimensions and margins for the graph
    var margin = { top: 20, right: 10, bottom: 50, left: 20 };
    var width = 560 - margin.left - margin.right;
    var height = 500 - margin.top - margin.bottom;

    // Append SVG object to the chart div
    const svg = svgContainer
        .attr("width", width + margin.left + margin.right)
        .attr("height", height + margin.top + margin.bottom)
        .append("g")
        .attr("transform", `translate(${margin.left},${margin.top})`);

    // X axis
    const x = d3.scaleBand()
        .range([0, width])
        .domain(customerData.map(d => d.City))
        .padding(0.1); document.addEventListener('DOMContentLoaded', function () {
            // Ensure the SVG container has the correct ID
            const svgContainer = d3.select('#bar-chart');

            // Set dimensions and margins for the graph
            // Set dimensions and margins for the graph
            var margin = { top: 20, right: 20, bottom: 50, left: 40 };
            var width = 560 - margin.left - margin.right;
            var height = 500 - margin.top - margin.bottom;

            // Append SVG object to the chart div
            const svg = svgContainer
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .append("g")
                .attr("transform", `translate(${margin.left},${margin.top})`);

            // Add X axis
            const x = d3.scaleLinear()
                .domain([0, d3.max(employeeEfficiencyData, d => +d.rates)])
                .range([0, width]);

            const xAxisGroup = svg.append("g")
                .attr("transform", `translate(0, ${height})`)
                .call(d3.axisBottom(x));

            // Add Y axis
            const y = d3.scaleLinear()
                .domain([0, d3.max(employeeEfficiencyData, d => +d.tasks_completed)])
                .range([height, 0]);

            const yAxisGroup = svg.append("g")
                .call(d3.axisLeft(y));

            // Add points
            svg.selectAll("dot")
                .data(employeeEfficiencyData)
                .enter().append("circle")
                .attr("cx", d => x(d.rates))
                .attr("cy", d => y(d.tasks_completed))
                .attr("r", 5) // Radius of the points
                .style("fill", "#69b3a2");

            // X axis label
            svg.append("text")
                .attr("text-anchor", "end")
                .attr("x", width / 2 + margin.left)
                .attr("y", height + margin.top + 20)
                .text("Rates")
                .attr("fill", "black")
                .attr("font-weight", "bold"); 

            // // Tooltip (assuming you have the correct CSS for .tooltip)
            // const tooltip = d3.select("body").append("div")
            //     .attr("class", "tooltip")
            //     .style("opacity", 0);

            // // Add interactivity (tooltip)
            // svg.selectAll("rect")
            //     .on("mouseover", function (event, d) {
            //         tooltip.transition()
            //             .duration(200)
            //             .style("opacity", .9);
            //         tooltip.html("City: " + d.City + "<br/>" + "Customers: " + d.NumberOfCustomers)
            //             .style("left", (event.pageX) + "px")
            //             .style("top", (event.pageY - 28) + "px");
            //     })
            //     .on("mouseout", function (d) {
            //         tooltip.transition()
            //             .duration(500)
            //             .style("opacity", 0);
            //     });
        });

}







