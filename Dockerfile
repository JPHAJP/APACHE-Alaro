# Use the official PHP image with Apache
FROM php:8.1-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the current directory contents into the container at /var/www/html
COPY . /var/www/html/

# Install Certbot, dependencies, and cron
RUN apt-get update && apt-get install -y \
    certbot \
    python3-certbot-apache \
    cron \
    nano

# Set the appropriate permissions (optional, adjust as necessary)
RUN chown -R www-data:www-data /var/www/html

# Copy the cron job script into the container
COPY certbot-renew /etc/cron.d/certbot-renew

# Apply the cron job script permissions
RUN chmod 0644 /etc/cron.d/certbot-renew

# Start the cron service and Apache server
CMD cron && apache2-foreground

# Expose ports 80 and 443 for HTTP and HTTPS traffic
EXPOSE 80 443
