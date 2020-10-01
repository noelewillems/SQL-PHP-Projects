
CREATE TABLE RIDES (
    RideID				Int 		NOT NULL	AUTO_INCREMENT,
    Church				Text 		NOT NULL,
    DepartingFrom		Text		NOT NULL,
    NumSeats			Int 		NOT NULL,
    AvailableDates		DateTime	NOT NULL,
    DepartureTime		Time		NOT NULL,
    DriverName			Text 		NOT NULL,
    DriverPhone			Int 		NOT NULL,
	PRIMARY KEY(RideID)
    );
    
CREATE TABLE RIDERS (
	RiderID				Int			NOT NULL	AUTO_INCREMENT,
    Name				Text		NOT NULL,
    RiderPhone			Int			NOT NULL,
    RideID				Int 		NOT NULL,
    PRIMARY KEY(RiderID), 
    CONSTRAINT RideID_FK FOREIGN KEY (RideID) REFERENCES RIDES(RideID) 
    ON UPDATE CASCADE ON DELETE CASCADE
);
