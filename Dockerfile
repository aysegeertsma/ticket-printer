FROM shincoder/homestead:php7.2

ENV DEBIAN_FRONTEND noninteractive

# Install packages
ADD docker-support/ticket-printer-provision.sh /root/ticket-printer-provision.sh

RUN chmod +x /root/*.sh

RUN ./root/ticket-printer-provision.sh

EXPOSE 80 22 35729 9876
CMD ["/usr/bin/supervisord"]
