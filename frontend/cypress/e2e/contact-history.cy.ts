describe('Contacts', () => {
  beforeEach(() => {
    cy.visit('http://localhost:5173')
    cy.get("input[name=email]").type("test@demo.cz")
    cy.get("input[name=password]").type("password123")
    cy.get("button").click()
    cy.intercept('POST', '/login').as('login');
    cy.wait('@login')
  })

  it('New call', () => {
    cy.get("nav [href='/contacts']").click()
    cy.get(".contact-list .contact-list.item").click()

    cy.get(".contact-history .new-call").click()
    cy.get(".call-result .call-purpose").type("To make an appointment")
    cy.get(".call-result .call-begin").click()
    cy.get(".call-result .call-successful").click()
    cy.get(".call-result .call-result-type").select("appointment")
    cy.get(".call-result .call-result-description").type("The client is interested in a meeting.")
    cy.get(".call-result .call-appointment-date").type("2025-11-25 13:00")
    cy.get(".call-result .call-appointment-place").type("Time Square")
    cy.get(".call-result .save-result")
  })

})