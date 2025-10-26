describe('Contacts', () => {
  beforeEach(() => {
    cy.visit('http://localhost:5173')
    cy.get(".login-form input[name=email]").should("exist").type("test@demo.cz")
    cy.get(".login-form input[name=password]").should("exist").type("password123")
    cy.intercept('POST', '/login').as('login');
    cy.get(".login-form button").should("exist").click()
    cy.wait(5000)
    cy.wait('@login')

    cy.intercept("GET", "/meeting").as('getMeeting')
    cy.get("nav [href='/calendar']").click()
    cy.wait(5000)
    cy.wait('@getMeeting')

  })

  it('View calendar', () => {
    cy.get(".calendar").should("exist")
    cy.get(".calendar .calendar-week").should("exist")
    
    cy.get(".calendar .calendar-week .monday").should("exist")
    cy.get(".calendar .calendar-week .tuesday").should("exist")
    cy.get(".calendar .calendar-week .wednesday").should("exist")
    cy.get(".calendar .calendar-week .thursday").should("exist")
    cy.get(".calendar .calendar-week .friday").should("exist")
    cy.get(".calendar .calendar-week .saturday").should("exist")
    cy.get(".calendar .calendar-week .sunday").should("exist")

    cy.get(".calendar .calendar-meeting").should("exist")
  })
    
})