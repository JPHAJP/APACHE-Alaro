# Use the official PHP image with Apache
FROM php:apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Set the appropriate permissions (optional, adjust as necessary)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to allow external access
EXPOSE 80

# Start the Apache server
CMD ["apache2-foreground"]

