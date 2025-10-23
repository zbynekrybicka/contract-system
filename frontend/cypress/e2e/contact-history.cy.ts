describe('Contacts', () => {
  beforeEach(() => {
    cy.visit('http://localhost:5173')
    cy.get("input[name=email]").type("test@demo.cz")
    cy.get("input[name=password]").type("password123")
    cy.get("button").click()
    cy.intercept('POST', '/login').as('login');
    cy.wait(5000)
    cy.wait('@login')
  })

  it('New call', () => {
    cy.intercept("GET", "/contact").as('getContact')
    cy.get("nav [href='/contacts']").click()
    cy.wait(5000)
    cy.wait('@getContact')

    cy.intercept("GET", "/contact/*").as('getContactDetail')
    cy.get(".contact-list .contact-list-item").first().click()
    cy.wait(5000)
    cy.wait('@getContactDetail')

    cy.get(".contact-history").should("exist")
    cy.get(".contact-history .new-call").should("exist").click()

    cy.get(".call-result").should("exist")
    cy.get(".call-result label textarea[name=purpose]").should("exist").type("To make an appointment")
    cy.get(".call-result .call-begin").should("exist").click()
    cy.get(".call-result label input[type=checkbox][name=successful]").should("exist").click()
    cy.get(".call-result label select[name=type]").should("exist").select("meeting")
    cy.get(".call-result label textarea[name=description]").should("exist").type("The client is interested in a meeting.")
    cy.get(".call-result label input[type=datetime-local][name=meeting-appointment]").should("exist").type("2025-11-25T13:00")
    cy.get(".call-result label input[name=place]").should("exist").type("Time Square")
    cy.intercept("POST", "/call").as('postCall')
    cy.get(".call-result .save-result").should("exist").click()
    cy.wait(5000)
    cy.wait('@postCall')
    cy.get(".call-result").should("not.exist")
  })

})