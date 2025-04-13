/**
 * Print helper for table printing
 * 
 * This file contains utility functions for printing tables in the admin area
 */

window.printTable = function(tableId, title) {
    // Create a new window for printing
    const printWindow = window.open('', '_blank');
    
    // Get the table to print
    const table = document.getElementById(tableId);
    
    if (!table) {
        console.error(`Table with ID "${tableId}" not found`);
        return;
    }
    
    // Create the print content
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>${title || 'Table Print'}</title>
            <style>
                body { 
                    font-family: Arial, sans-serif;
                    margin: 20px;
                }
                table { 
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td { 
                    padding: 8px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th { 
                    background-color: #f2f2f2;
                    font-weight: bold;
                }
                .header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 20px;
                }
                .logo {
                    font-weight: bold;
                    font-size: 24px;
                }
                .date {
                    font-size: 14px;
                }
                .controls {
                    margin-top: 20px;
                    text-align: center;
                }
                .controls button {
                    padding: 8px 16px;
                    margin: 0 5px;
                    background-color: #f0f0f0;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    cursor: pointer;
                }
                .controls button:hover {
                    background-color: #e0e0e0;
                }
                @media print {
                    .controls { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">${title || 'Data Table'}</div>
                <div class="date">Generated on: ${new Date().toLocaleString()}</div>
            </div>
            ${table.outerHTML}
            <div class="controls">
                <button onclick="window.print()">Print</button>
                <button onclick="window.close()">Close</button>
            </div>
            <script>
                // Auto-print when the page loads
                window.onload = function() { 
                    // Small delay to ensure content is fully loaded
                    setTimeout(function() {
                        window.print();
                    }, 500);
                }
            </script>
        </body>
        </html>
    `;
    
    // Write to the new window and trigger print
    printWindow.document.open();
    printWindow.document.write(printContent);
    printWindow.document.close();
};